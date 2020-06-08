<?php


namespace Modules\Media\Libs\Request\RequestWriter\Traits;


use Modules\Media\Models\ExternalLink\ExternalLink;

trait ExternalLinkTrait
{
    private function attachLinks($entity = null)
    {
        if(!isset($this->entity))
            $this->entity = $entity;

        $newLinks = isset($this->request['links']) ? $this->request['links'] : request()->get('links',[]);

        $newResources = array_keys($newLinks);

        $this->entity->externalLinks->each(function ($l) use ($newResources) {
            if(!in_array($l->resource, $newResources))
                $l->delete();
        });

        foreach ($newLinks as $resource => $link) {
            $existing = $this->entity->externalLinks->firstWhere('resource', $resource);
            if ($existing) {
                if ($link)
                    $existing->update([
                        'link' => $link
                    ]);
                else $existing->delete();
            } else {
                $externalLink = new ExternalLink([
                    'resource' => $resource,
                    'link' => $link,
                ]);
                $this->entity->externalLinks()->save($externalLink);
            }
        }
    }
}

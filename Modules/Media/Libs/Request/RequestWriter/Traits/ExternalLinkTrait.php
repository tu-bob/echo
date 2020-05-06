<?php


namespace Modules\Media\Libs\Request\RequestWriter\Traits;


use Modules\Media\Models\ExternalLink\ExternalLink;

trait ExternalLinkTrait
{
    private function attachLinks()
    {
        $newLinks = isset($this->request['links']) ? $this->request['links'] : [];

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

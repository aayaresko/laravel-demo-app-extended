<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 19.08.16
 * Time: 10:57
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Decorators;

class CombineAttributesDecorator extends BaseDecorator
{
    /**
     * Generates a string based on `$template` content and current `$model` attributes.
     *
     * You can specify any number of attributes enclosed in { and } (e.g. {alias_name}).
     * Of course, attribute should exist in current `$model`.
     * You can use "dot" notation to specify relational attribute (e.g. {category.alias_name}).
     * It support maximum 3 levels 'depth' (e.g. {post.author.name}).
     * Of course, relation and related attributes should exists.
     * In any other cases - parts of the template will be replaced with an empty string.
     *
     * @param string $template
     * @return mixed
     */
    public function formatString($template = '{first_name} {last_name}')
    {
        $content = preg_replace_callback(
            '~{(\w+)\.?(\w+)?\.?(\w+)?}~',
            function ($matches) {
                $counter = count($matches);
                $attributes = [];
                if ($counter > 1) {
                    $attributes[] = next($matches);
                }
                if ($counter > 2) {
                    $attributes[] = next($matches);
                }
                $counter = count($attributes);
                if ($counter) {
                    $matches = reset($matches);
                    $attribute = reset($attributes);
                    switch ($counter) {
                        case 1:
                            $content = $this->model->getAttribute($attribute);
                            break;
                        case 2:
                            $relation = $this->model->getRelationValue($attribute);
                            $attribute = next($attributes);
                            $content = $relation->{$attribute};
                            break;
                        case 3:
                            $relation = $this->model->getRelationValue($attribute);
                            $relation = $relation->getRelationValue(next($attributes));
                            $attribute = next($attributes);
                            $content = $relation->{$attribute};
                            break;
                        default:
                            $content = false;
                    }
                    return $content === false ? $matches : $content;
                }
                return null;
            },
            $template
        );
        return $content;
    }
}
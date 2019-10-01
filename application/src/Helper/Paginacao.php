<?php

namespace Helper;

class Paginacao
{
   protected $page=1;
  
   protected $totalPages;

   protected $margin = 2;

   protected $route;

   protected $params = [];

   protected $query = [];

   protected $prev = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>';

   protected $next = '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>';

   public function setRoute(\Route $route, array $params = [])
   {
      $this->route = $route;
      $this->params = $params;
      return $this;
   }

   public function addQuery($key, $value)
   {
      $this->query[$key] = $value;
      return $this;
   }

   public function setPage($page)
   {
      $this->page = $page;
      return $this;
   }

   public function setTotalPages($totalPages)
   {
      $this->totalPages = $totalPages;
      return $this;
   }

   public function __toString()
   {
      if ( $this->totalPages > 1 )
      {
         $start = $this->page-$this->margin >= 1 ? $this->page-$this->margin : 1;
         $end = $this->page+$this->margin < $this->totalPages ? $this->page+$this->margin : $this->totalPages;

         $query = $this->query ? '?'.http_build_query($this->query) : '';

         $html[] = '<nav>';
            $html[] = '<ul class="pagination">';

               if ( $this->page > 1 )
               {
                  $html[] = '<li>';
                     $html[] = sprintf('<a href="%s">%s</a>', $this->route ? \URL::site($this->route->uri(array_merge($this->params, ['page' => $this->page-1]))).$query : '#', $this->prev);
                  $html[] = '</li>';
               }

               if ( $this->page-$this->margin > 1 )
               {
                  $html[] = '<li>';
                     $html[] = sprintf('<a href="%s">%s</a>', $this->route ? \URL::site($this->route->uri(array_merge($this->params, ['page' => 1]))).$query : '#', 1);
                  $html[] = '</li>';

                  $html[] = '<li class="disabled">';
                     $html[] = '<a href="#">...</a>';
                  $html[] = '</li>';
               }

               foreach (range($start, $end) as $page)
               {
                  $html[] = sprintf('<li class="%s">', $this->page == $page ? 'active' : '');
                     $html[] = sprintf('<a href="%s">%s</a>', $this->route ? \URL::site($this->route->uri(array_merge($this->params, ['page' => $page]))).$query : '#', $page);
                  $html[] = '</li>';
               }

               if ( $this->page+$this->margin < $this->totalPages )
               {
                  $html[] = '<li class="disabled">';
                     $html[] = '<a href="#">...</a>';
                  $html[] = '</li>';

                  $html[] = '<li>';
                     $html[] = sprintf('<a href="%s">%s</a>', $this->route ? \URL::site($this->route->uri(array_merge($this->params, ['page' => $this->totalPages]))).$query : '#', $this->totalPages);
                  $html[] = '</li>';
               }

               if ( $this->page < $this->totalPages )
               {
                  $html[] = '<li>';
                     $html[] = sprintf('<a href="%s">%s</a>', $this->route ? \URL::site($this->route->uri(array_merge($this->params, ['page' => $this->page+1]))).$query : '#', $this->next);
                  $html[] = '</li>';
               }

            $html[] = '</ul>';
         $html[] = '</nav>';

         return implode('', $html);
      }

      return '';
   }

}
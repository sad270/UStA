function addButtonsHeight($container) {
        $container.height($container.parent().children(':nth-last-child(3)').height());
      $container.children("a").css('line-height' , ($container.height())+ "px");
}

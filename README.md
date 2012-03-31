This project is searching for new core developers, if you are interested please hop on tu forums at http://groups.google.com/group/addendum-discuss

DocBlock/JavaDoc annotations support for PHP5. Supporting single and multi valued annotations accessible through extended Reflection API.

### Example annotations:
```
@SimpleAnnotation
@SingleValuedAnnotation(true)
@SingleValuedAnnotation(-3.141592)
@SingleValuedAnnotation('Hello World!')
@SingleValuedAnnotationWithArray({1, 2, 3})
@MultiValuedAnnotation(key = 'value', anotherKey = false, andMore = 1234)
```

### Annotate classes, methods, properties.

Works also if --preserve-docs is disabled.

### Tutorial

Checkout [Short Tutorial By Example](https://github.com/s-larionov/Addendum/wiki/Addendum-annotation-basics) for a quick introduction to annotations using Addendum.

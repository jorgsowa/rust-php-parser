===description===
PHP emits a warning (not fatal) for `final private` methods:
"Private methods cannot be final as they are never overridden by other classes".
The parser surfaces this as a ForbiddenWarning diagnostic
(severity = Warning); `php -l` still exits 0 so there is no
===php_error=== section. __construct is excluded — PHP allows
`final private __construct`.
===source===
<?php
class A {
    final private function f() {}
}
===errors===
Private methods cannot be final as they are never overridden by other classes
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "f",
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}

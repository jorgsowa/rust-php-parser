===source===
<?php
class C {
    const D = function () {};
}
===errors <=8.4===
'closures in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Closures in constant expressions must be static
===php_error <=8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Closures in constant expressions must be static in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Closure": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [],
                        "return_type": null,
                        "body": [],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 44
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}

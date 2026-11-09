===source===
<?php
class A {
    final private const X = 1;
}
===errors <=8.0===
'final class constants' requires PHP 8.1 or higher
Private constant A::X cannot be final as it is not visible to other classes
===errors >=8.1===
Private constant A::X cannot be final as it is not visible to other classes
===php_error <=8.0===
PHP Fatal error:  Cannot use 'final' as constant modifier in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Private constant A::X cannot be final as it is not visible to other classes in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                    "name": "X",
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 44,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}

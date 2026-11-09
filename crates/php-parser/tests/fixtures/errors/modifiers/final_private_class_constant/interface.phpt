===source===
<?php
interface I {
    final private const X = 1;
}
===errors <=8.0===
'final class constants' requires PHP 8.1 or higher
Private constant I::X cannot be final as it is not visible to other classes
Access type for interface constant I::X must be public
===errors >=8.1===
Private constant I::X cannot be final as it is not visible to other classes
Access type for interface constant I::X must be public
===php_error <=8.0===
PHP Fatal error:  Cannot use 'final' as constant modifier in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Private constant I::X cannot be final as it is not visible to other classes in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 44,
                      "end": 45
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
                      "start": 48,
                      "end": 49
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

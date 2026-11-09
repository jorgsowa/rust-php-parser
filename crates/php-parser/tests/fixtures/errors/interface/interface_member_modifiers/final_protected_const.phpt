===source===
<?php
interface I {
    final protected const D = 1;
}
===errors <=8.0===
'final class constants' requires PHP 8.1 or higher
Access type for interface constant I::D must be public
===errors >=8.1===
Access type for interface constant I::D must be public
===php_error <=8.0===
PHP Fatal error:  Cannot use 'final' as constant modifier in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Access type for interface constant I::D must be public in Standard input code on line 3
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
                    "name": "D",
                    "span": {
                      "start": 46,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}

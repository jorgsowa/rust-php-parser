===source===
<?php
trait T {
    final const Y = $b;
}
===errors <=8.0===
'constants in traits' requires PHP 8.2 or higher
'final class constants' requires PHP 8.1 or higher
===errors 8.1===
'constants in traits' requires PHP 8.2 or higher
===errors >=8.2===
Constant expression contains invalid operations
===php_error <=8.1===
PHP Fatal error:  Traits cannot have constants in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

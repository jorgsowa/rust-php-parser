===source===
<?php
trait T {
    const class = 1;
}
===errors <=8.1===
'constants in traits' requires PHP 8.2 or higher
===errors >=8.2===
A class constant must not be called 'class'; it is reserved for class name fetching
===php_error <=8.1===
PHP Fatal error:  Traits cannot have constants in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  A class constant must not be called 'class'; it is reserved for class name fetching in Standard input code on line 3
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
                    "name": "class",
                    "span": {
                      "start": 26,
                      "end": 31
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 34,
                      "end": 35
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 36
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}

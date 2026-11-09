===source===
<?php
interface I {
    protected const A = 1;
}
===errors===
Access type for interface constant I::A must be public
===php_error===
PHP Fatal error:  Access type for interface constant I::A must be public in Standard input code on line 3
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
                    "name": "A",
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
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
                "start": 24,
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

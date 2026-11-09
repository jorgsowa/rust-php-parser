===source===
<?php
function f() {
    static $b = 1, $b;
}
===errors >=8.3===
Duplicate declaration of static variable $b
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $b in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 37,
                        "end": 38
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 38
                    }
                  },
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 43
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}

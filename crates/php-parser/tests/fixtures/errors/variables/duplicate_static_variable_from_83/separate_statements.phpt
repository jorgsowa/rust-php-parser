===source===
<?php
function f() {
    static $a;
    static $a;
}
===errors >=8.3===
Duplicate declaration of static variable $a
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 4
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
                      "name": "a",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 35
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 47,
                        "end": 49
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 47,
                      "end": 49
                    }
                  }
                ]
              },
              "span": {
                "start": 40,
                "end": 50
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
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

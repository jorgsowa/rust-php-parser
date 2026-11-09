===source===
<?php
function f() {
    static $b, $b;
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
                    "default": null,
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  },
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 36,
                        "end": 38
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 39
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

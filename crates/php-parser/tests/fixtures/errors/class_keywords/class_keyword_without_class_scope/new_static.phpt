===source===
<?php
function f() {
    new static;
}
===errors===
Cannot use "static" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 3
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
                "Expression": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 29,
                              "end": 35
                            }
                          }
                        },
                        "span": {
                          "start": 29,
                          "end": 35
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 36
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
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}

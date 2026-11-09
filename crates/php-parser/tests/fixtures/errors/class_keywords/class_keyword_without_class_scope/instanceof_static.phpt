===source===
<?php
function f($a) {
    $a instanceof static;
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
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 19
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 27,
                          "end": 29
                        }
                      },
                      "op": "Instanceof",
                      "right": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 41,
                              "end": 47
                            }
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 47
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 47
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 48
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
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}

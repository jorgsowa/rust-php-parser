===source===
<?php
function f(mixed\X&object\Y $a) {}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected namespaced name "object\Y", expecting variable in Standard input code on line 2
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
                  "start": 34,
                  "end": 36
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "mixed",
                            "X"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 17,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 24
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "object",
                            "Y"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 25,
                            "end": 33
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 33
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 33
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 36
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}

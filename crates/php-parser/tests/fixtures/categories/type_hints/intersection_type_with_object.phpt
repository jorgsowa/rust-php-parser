===source===
<?php function foo(Iterator&Countable $x): void {}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Countable", expecting variable in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 38,
                  "end": 40
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Iterator"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 27
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 37
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 37
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 40
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 43,
                  "end": 47
                }
              }
            },
            "span": {
              "start": 43,
              "end": 47
            }
          },
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

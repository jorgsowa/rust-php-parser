===source===
<?php
function c(\Foo\Bar|\Integer $a): \Traversable {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
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
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo",
                            "Bar"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 17,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 25
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Integer"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 26,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 37
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "Traversable"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 40,
                  "end": 52
                }
              }
            },
            "span": {
              "start": 40,
              "end": 52
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}

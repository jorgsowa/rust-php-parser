===source===
<?php
function foo((Foo&mixed)|Bar $x) { }

===errors >=8.2===
Type mixed cannot be part of an intersection type
===php_error===
PHP Fatal error:  Type mixed cannot be part of an intersection type in Standard input code on line 2
===ast >=8.2===
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
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 20,
                                  "end": 23
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 23
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "mixed"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 29
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 30
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Bar"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 31,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 37
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
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

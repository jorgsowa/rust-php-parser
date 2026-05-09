===config===
min_php=8.2

===source===
<?php
function foo((mixed&Foo)|Bar $x) { }

===errors===
mixed cannot be used in intersection types
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
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
                                  "mixed"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 20,
                                  "end": 25
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 25
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 26,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 26,
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
===php_error===
PHP Fatal error:  Type mixed cannot be part of an intersection type in Standard input code on line 2

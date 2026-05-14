===config===
min_php=8.2

===source===
<?php
function foo((Foo|Bar)&Baz $x) { }

===errors===
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
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
                  "Intersection": [
                    {
                      "kind": {
                        "Union": [
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
                                  "Bar"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 27
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 27
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 28
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Baz"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 29,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 32
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
                "end": 35
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
===php_error===
PHP Parse error:  syntax error, unexpected token "|", expecting token "&" in Standard input code on line 2

===config===
min_php=8.5

===source===
<?php
function foo((A|B|C)&D $x) { }

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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 20,
                                  "end": 21
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 22,
                                  "end": 23
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 25
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 26
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "D"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 28
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
                "end": 31
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
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "|", expecting token "&" in Standard input code on line 2

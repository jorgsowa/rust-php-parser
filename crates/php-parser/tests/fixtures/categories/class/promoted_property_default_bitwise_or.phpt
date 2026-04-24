===source===
<?php class Foo { public function __construct(public int $flags = FLAG_A | FLAG_B) {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "flags",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 53,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 53,
                          "end": 56
                        }
                      },
                      "default": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Identifier": "FLAG_A"
                              },
                              "span": {
                                "start": 66,
                                "end": 72
                              }
                            },
                            "op": "BitwiseOr",
                            "right": {
                              "kind": {
                                "Identifier": "FLAG_B"
                              },
                              "span": {
                                "start": 75,
                                "end": 81
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 66,
                          "end": 81
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 81
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 85
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}

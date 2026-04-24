===config===
min_php=8.1
===source===
<?php
class Foo {
    public function __construct(
        readonly protected string $a,
        readonly private int $b,
        private readonly int $c,
    ) {}
}
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
                      "name": "a",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 78,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 78,
                          "end": 84
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Protected",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 87
                      }
                    },
                    {
                      "name": "b",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 114,
                              "end": 117
                            }
                          }
                        },
                        "span": {
                          "start": 114,
                          "end": 117
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 97,
                        "end": 120
                      }
                    },
                    {
                      "name": "c",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 147,
                              "end": 150
                            }
                          }
                        },
                        "span": {
                          "start": 147,
                          "end": 150
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 130,
                        "end": 153
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 163
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 165
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 165
  }
}

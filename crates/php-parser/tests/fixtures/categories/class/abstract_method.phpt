===source===
<?php abstract class Foo { abstract protected function bar(int $x): string; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 21,
              "end": 24
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 55,
                      "end": 58
                    }
                  },
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 63,
                          "end": 65
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 59,
                              "end": 62
                            }
                          }
                        },
                        "span": {
                          "start": 59,
                          "end": 62
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
                        "start": 59,
                        "end": 65
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 68,
                          "end": 74
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 74
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 75
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 77
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77
  }
}

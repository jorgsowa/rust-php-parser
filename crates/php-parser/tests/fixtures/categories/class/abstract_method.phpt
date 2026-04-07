===source===
<?php abstract class Foo { abstract protected function bar(int $x): string; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "bar",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
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
                "end": 76
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

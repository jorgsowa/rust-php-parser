===source===
<?php function foo(Iterator&Countable $x): void {}
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
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 38
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 38
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

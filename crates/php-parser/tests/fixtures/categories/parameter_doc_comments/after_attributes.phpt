===source===
<?php
function f(
    #[A]
    /** first */
    $a,
    /** before */
    #[A]
    /** second */
    $b
) {}
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
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
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "doc_comment": {
                "kind": "Doc",
                "text": "/** first */",
                "span": {
                  "start": 31,
                  "end": 43
                }
              },
              "span": {
                "start": 48,
                "end": 50
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 101,
                  "end": 103
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "doc_comment": {
                "kind": "Doc",
                "text": "/** second */",
                "span": {
                  "start": 83,
                  "end": 96
                }
              },
              "span": {
                "start": 101,
                "end": 103
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
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
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
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                }
              ],
              "doc_comment": {
                "kind": "Doc",
                "text": "/** first */",
                "span": {
                  "start": 31,
                  "end": 43
                }
              },
              "span": {
                "start": 22,
                "end": 50
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 101,
                  "end": 103
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 76,
                      "end": 77
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 76,
                    "end": 77
                  }
                }
              ],
              "doc_comment": {
                "kind": "Doc",
                "text": "/** second */",
                "span": {
                  "start": 83,
                  "end": 96
                }
              },
              "span": {
                "start": 74,
                "end": 103
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
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108
  }
}

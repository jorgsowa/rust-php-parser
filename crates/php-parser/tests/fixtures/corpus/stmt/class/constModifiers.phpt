===source===
<?php

class Foo {
    const A = 1;
    public const B = 2;
    protected const C = 3;
    private const D = 4;
    final const E = 5;
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
                "ClassConst": {
                  "name": "A",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 33,
                      "end": 34,
                      "start_line": 4,
                      "start_col": 14
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 40,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "B",
                  "visibility": "Public",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 57,
                      "end": 58,
                      "start_line": 5,
                      "start_col": 21
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 64,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "C",
                  "visibility": "Protected",
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 84,
                      "end": 85,
                      "start_line": 6,
                      "start_col": 24
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 91,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "D",
                  "visibility": "Private",
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 109,
                      "end": 110,
                      "start_line": 7,
                      "start_col": 22
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 91,
                "end": 116,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "E",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 5
                    },
                    "span": {
                      "start": 132,
                      "end": 133,
                      "start_line": 8,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 116,
                "end": 135,
                "start_line": 8,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 136,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 136,
    "start_line": 1,
    "start_col": 0
  }
}

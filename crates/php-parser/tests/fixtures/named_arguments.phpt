===source===
<?php htmlspecialchars(string: $str, flags: ENT_QUOTES, encoding: 'UTF-8');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "htmlspecialchars"
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 23,
                      "end": 29
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "str"
                    },
                    "span": {
                      "start": 31,
                      "end": 35
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 23,
                    "end": 35
                  }
                },
                {
                  "name": {
                    "parts": [
                      "flags"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 37,
                      "end": 42
                    }
                  },
                  "value": {
                    "kind": {
                      "Identifier": "ENT_QUOTES"
                    },
                    "span": {
                      "start": 44,
                      "end": 54
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 37,
                    "end": 54
                  }
                },
                {
                  "name": {
                    "parts": [
                      "encoding"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 56,
                      "end": 64
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "UTF-8"
                    },
                    "span": {
                      "start": 66,
                      "end": 73
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 56,
                    "end": 73
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 74
          }
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}

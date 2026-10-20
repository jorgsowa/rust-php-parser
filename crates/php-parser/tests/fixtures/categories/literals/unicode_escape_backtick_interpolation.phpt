===source===
<?php
`\u{1F4A9}$var\u{2764}`;
`{$arr[0]}\u{1F600}{$obj->method()}`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "💩"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "var"
                  },
                  "span": {
                    "start": 16,
                    "end": 20
                  }
                }
              },
              {
                "Literal": "❤"
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "arr"
                        },
                        "span": {
                          "start": 33,
                          "end": 37
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 38,
                          "end": 39
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 40
                  }
                }
              },
              {
                "Literal": "😀"
              },
              {
                "Expr": {
                  "kind": {
                    "MethodCall": {
                      "object": {
                        "kind": {
                          "Variable": "obj"
                        },
                        "span": {
                          "start": 51,
                          "end": 55
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "method"
                        },
                        "span": {
                          "start": 57,
                          "end": 63
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 51,
                    "end": 65
                  }
                }
              }
            ]
          },
          "span": {
            "start": 31,
            "end": 67
          }
        }
      },
      "span": {
        "start": 31,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}

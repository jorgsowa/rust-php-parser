===source===
<?php
/** @var Iterator $it */
while ($it->valid()) {
    $it->next();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "MethodCall": {
                "object": {
                  "kind": {
                    "Variable": "it"
                  },
                  "span": {
                    "start": 38,
                    "end": 41
                  }
                },
                "method": {
                  "kind": {
                    "Identifier": "valid"
                  },
                  "span": {
                    "start": 43,
                    "end": 48
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 38,
              "end": 50
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "it"
                            },
                            "span": {
                              "start": 58,
                              "end": 61
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "next"
                            },
                            "span": {
                              "start": 63,
                              "end": 67
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 69
                      }
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 70
                  }
                }
              ]
            },
            "span": {
              "start": 52,
              "end": 72
            }
          }
        }
      },
      "span": {
        "start": 31,
        "end": 72
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** @var Iterator $it */",
        "span": {
          "start": 6,
          "end": 30
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}

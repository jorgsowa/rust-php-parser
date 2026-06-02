===source===
<?php
function outer(): void {
    /** @var string $x */
    $x = compute();

    /** @return int */
    function inner(): int { return 1; }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "outer",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 61,
                          "end": 63
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "compute"
                              },
                              "span": {
                                "start": 66,
                                "end": 73
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 66,
                          "end": 75
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 61,
                    "end": 75
                  }
                }
              },
              "span": {
                "start": 61,
                "end": 76
              },
              "doc_comment": {
                "kind": "Doc",
                "text": "/** @var string $x */",
                "span": {
                  "start": 35,
                  "end": 56
                }
              }
            },
            {
              "kind": {
                "Function": {
                  "name": "inner",
                  "params": [],
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 136,
                            "end": 137
                          }
                        }
                      },
                      "span": {
                        "start": 129,
                        "end": 138
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 123,
                          "end": 126
                        }
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 126
                    }
                  },
                  "by_ref": false,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @return int */",
                    "span": {
                      "start": 82,
                      "end": 100
                    }
                  }
                }
              },
              "span": {
                "start": 105,
                "end": 140
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 24,
                  "end": 28
                }
              }
            },
            "span": {
              "start": 24,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 142
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 142
  }
}

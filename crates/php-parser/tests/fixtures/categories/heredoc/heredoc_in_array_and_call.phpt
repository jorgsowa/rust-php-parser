===source===
<?php
$a = [<<<X
	body
	X, 'other'];
bar(<<<X
	body
	X . 'suffix');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Heredoc": {
                            "label": "X",
                            "parts": [
                              {
                                "Literal": "body"
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 25
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "String": "other"
                        },
                        "span": {
                          "start": 27,
                          "end": 34
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 27,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 37,
                  "end": 40
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Heredoc": {
                              "label": "X",
                              "parts": [
                                {
                                  "Literal": "body"
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 54
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": "suffix"
                          },
                          "span": {
                            "start": 57,
                            "end": 65
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 65
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 41,
                    "end": 65
                  }
                }
              ]
            }
          },
          "span": {
            "start": 37,
            "end": 66
          }
        }
      },
      "span": {
        "start": 37,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}

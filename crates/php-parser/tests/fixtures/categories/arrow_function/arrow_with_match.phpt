===source===
<?php $classify = fn($n) => match(true) { $n < 0 => 'neg', $n === 0 => 'zero', default => 'pos' };
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
                  "Variable": "classify"
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "n",
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 21,
                          "end": 23
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Match": {
                          "subject": {
                            "kind": {
                              "Bool": true
                            },
                            "span": {
                              "start": 34,
                              "end": 38
                            }
                          },
                          "arms": [
                            {
                              "conditions": [
                                {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "n"
                                        },
                                        "span": {
                                          "start": 42,
                                          "end": 44
                                        }
                                      },
                                      "op": "Less",
                                      "right": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 47,
                                          "end": 48
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 42,
                                    "end": 48
                                  }
                                }
                              ],
                              "body": {
                                "kind": {
                                  "String": "neg"
                                },
                                "span": {
                                  "start": 52,
                                  "end": 57
                                }
                              },
                              "span": {
                                "start": 42,
                                "end": 57
                              }
                            },
                            {
                              "conditions": [
                                {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "n"
                                        },
                                        "span": {
                                          "start": 59,
                                          "end": 61
                                        }
                                      },
                                      "op": "Identical",
                                      "right": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 66,
                                          "end": 67
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 59,
                                    "end": 67
                                  }
                                }
                              ],
                              "body": {
                                "kind": {
                                  "String": "zero"
                                },
                                "span": {
                                  "start": 71,
                                  "end": 77
                                }
                              },
                              "span": {
                                "start": 59,
                                "end": 77
                              }
                            },
                            {
                              "conditions": null,
                              "body": {
                                "kind": {
                                  "String": "pos"
                                },
                                "span": {
                                  "start": 90,
                                  "end": 95
                                }
                              },
                              "span": {
                                "start": 79,
                                "end": 95
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 97
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 18,
                  "end": 97
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 97
          }
        }
      },
      "span": {
        "start": 6,
        "end": 98
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 98
  }
}

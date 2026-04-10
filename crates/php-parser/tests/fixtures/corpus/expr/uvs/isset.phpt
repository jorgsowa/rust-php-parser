===source===
<?php

isset(([0, 1] + [])[0]);
isset(['a' => 'b']->a);
isset("str"->a);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 15,
                                          "end": 16
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 15,
                                        "end": 16
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 18,
                                          "end": 19
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 18,
                                        "end": 19
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 14,
                                  "end": 20
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Array": []
                                },
                                "span": {
                                  "start": 23,
                                  "end": 25
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 14,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 26
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 29
                }
              }
            ]
          },
          "span": {
            "start": 7,
            "end": 30
          }
        }
      },
      "span": {
        "start": 7,
        "end": 31
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 39,
                                "end": 42
                              }
                            },
                            "value": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 46,
                                "end": 49
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 39,
                              "end": 49
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 38,
                        "end": 50
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 53
                }
              }
            ]
          },
          "span": {
            "start": 32,
            "end": 54
          }
        }
      },
      "span": {
        "start": 32,
        "end": 55
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "String": "str"
                      },
                      "span": {
                        "start": 62,
                        "end": 67
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 69,
                        "end": 70
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 70
                }
              }
            ]
          },
          "span": {
            "start": 56,
            "end": 71
          }
        }
      },
      "span": {
        "start": 56,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}

===source===
<?php
const C = new Foo();
const D = 1, E = new Bar(1, 2);

function f() {
    static $a = new Cache();
    static $b = new Store(), $c = new Other();
}
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 20,
                          "end": 23
                        }
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 33,
                "end": 34
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 37,
                "end": 38
              }
            },
            "attributes": [],
            "span": {
              "start": 33,
              "end": 38
            }
          },
          {
            "name": {
              "name": "E",
              "span": {
                "start": 40,
                "end": 41
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Bar"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 48,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 48,
                      "end": 51
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 52,
                            "end": 53
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 55,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 55,
                        "end": 56
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 44,
                "end": 57
              }
            },
            "attributes": [],
            "span": {
              "start": 40,
              "end": 57
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 58
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 69,
              "end": 70
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 86,
                        "end": 88
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Cache"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 95,
                                  "end": 100
                                }
                              }
                            },
                            "span": {
                              "start": 95,
                              "end": 100
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 102
                      }
                    },
                    "span": {
                      "start": 86,
                      "end": 102
                    }
                  }
                ]
              },
              "span": {
                "start": 79,
                "end": 103
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 115,
                        "end": 117
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Store"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 124,
                                  "end": 129
                                }
                              }
                            },
                            "span": {
                              "start": 124,
                              "end": 129
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 120,
                        "end": 131
                      }
                    },
                    "span": {
                      "start": 115,
                      "end": 131
                    }
                  },
                  {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 133,
                        "end": 135
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Other"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 142,
                                  "end": 147
                                }
                              }
                            },
                            "span": {
                              "start": 142,
                              "end": 147
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 149
                      }
                    },
                    "span": {
                      "start": 133,
                      "end": 149
                    }
                  }
                ]
              },
              "span": {
                "start": 108,
                "end": 150
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 60,
        "end": 152
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 152
  }
}

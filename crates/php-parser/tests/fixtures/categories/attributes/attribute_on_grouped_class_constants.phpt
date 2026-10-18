===source===
<?php
class C {
    #[A(1, X)]
    public const A = 1, B = 2;
}
interface I { #[A] const X = 1, Y = 2; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  },
                  "visibility": "Public",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 52,
                      "end": 53
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 23
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        },
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "X"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 27,
                                  "end": 28
                                }
                              }
                            },
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 27,
                            "end": 28
                          }
                        }
                      ],
                      "span": {
                        "start": 22,
                        "end": 29
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 55,
                      "end": 56
                    }
                  },
                  "visibility": "Public",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 59,
                      "end": 60
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 23
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        },
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "X"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 27,
                                  "end": 28
                                }
                              }
                            },
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 27,
                            "end": 28
                          }
                        }
                      ],
                      "span": {
                        "start": 22,
                        "end": 29
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 74,
              "end": 75
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 89,
                      "end": 90
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 93,
                      "end": 94
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 80,
                          "end": 81
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 80,
                        "end": 81
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 78,
                "end": 102
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 96,
                      "end": 97
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 100,
                      "end": 101
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 80,
                          "end": 81
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 80,
                        "end": 81
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 78,
                "end": 102
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}

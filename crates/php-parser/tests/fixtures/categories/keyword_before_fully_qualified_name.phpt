===source===
<?php
include \dirname(__DIR__);
print \x();
fn\use();
private\protected\x();
exit(\foo());
require_once \A::B;
$a = clone \foo();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Include",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "dirname"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 14,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 22
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "MagicConst": "Dir"
                          },
                          "span": {
                            "start": 23,
                            "end": 30
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 23,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 14,
                  "end": 31
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "x"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 39,
                          "end": 41
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 39,
                "end": 43
              }
            }
          },
          "span": {
            "start": 33,
            "end": 43
          }
        }
      },
      "span": {
        "start": 33,
        "end": 44
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 45,
                      "end": 51
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 51
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 45,
            "end": 53
          }
        }
      },
      "span": {
        "start": 45,
        "end": 54
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "private",
                      "protected",
                      "x"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 55,
                      "end": 74
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 74
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 55,
            "end": 76
          }
        }
      },
      "span": {
        "start": 55,
        "end": 77
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "foo"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 83,
                          "end": 87
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 87
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 83,
                "end": 89
              }
            }
          },
          "span": {
            "start": 78,
            "end": 90
          }
        }
      },
      "span": {
        "start": 78,
        "end": 91
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "RequireOnce",
              {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 105,
                            "end": 107
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 107
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 109,
                        "end": 110
                      }
                    }
                  }
                },
                "span": {
                  "start": 105,
                  "end": 110
                }
              }
            ]
          },
          "span": {
            "start": 92,
            "end": 110
          }
        }
      },
      "span": {
        "start": 92,
        "end": 111
      }
    },
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
                  "start": 112,
                  "end": 114
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "foo"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 123,
                                "end": 127
                              }
                            }
                          },
                          "span": {
                            "start": 123,
                            "end": 127
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 129
                    }
                  }
                },
                "span": {
                  "start": 117,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 112,
            "end": 129
          }
        }
      },
      "span": {
        "start": 112,
        "end": 130
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130
  }
}

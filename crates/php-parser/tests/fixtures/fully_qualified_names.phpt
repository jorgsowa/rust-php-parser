===source===
<?php
$e = new \Exception('error');
\App\Services\Logger::log('msg');
$x = \strlen('hello');
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
                  "Variable": "e"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Exception"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 15,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 25
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "error"
                          },
                          "span": {
                            "start": 26,
                            "end": 33
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 26,
                          "end": 33
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "App",
                      "Services",
                      "Logger"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 36,
                      "end": 56
                    }
                  }
                },
                "span": {
                  "start": 36,
                  "end": 56
                }
              },
              "method": {
                "kind": {
                  "Identifier": "log"
                },
                "span": {
                  "start": 58,
                  "end": 61
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "msg"
                    },
                    "span": {
                      "start": 62,
                      "end": 67
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 62,
                    "end": 67
                  }
                }
              ]
            }
          },
          "span": {
            "start": 36,
            "end": 68
          }
        }
      },
      "span": {
        "start": 36,
        "end": 69
      }
    },
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
                  "start": 70,
                  "end": 72
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "strlen"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 75,
                            "end": 82
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 82
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "hello"
                          },
                          "span": {
                            "start": 83,
                            "end": 90
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 83,
                          "end": 90
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 75,
                  "end": 91
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 91
          }
        }
      },
      "span": {
        "start": 70,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}

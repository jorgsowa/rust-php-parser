===source===
<?php
$a = "$b?->c";
$a = "$b?->c->d";
$a = "$b?-> c";
$a = <<<EOT
$b?->c
EOT;
$a = `$b?->c`;
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
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 12,
                                "end": 14
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "c"
                              },
                              "span": {
                                "start": 17,
                                "end": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 18
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
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
                  "start": 21,
                  "end": 23
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 27,
                                "end": 29
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "c"
                              },
                              "span": {
                                "start": 32,
                                "end": 33
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 33
                        }
                      }
                    },
                    {
                      "Literal": "->d"
                    }
                  ]
                },
                "span": {
                  "start": 26,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 37
          }
        }
      },
      "span": {
        "start": 21,
        "end": 38
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
                  "start": 39,
                  "end": 41
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 45,
                          "end": 47
                        }
                      }
                    },
                    {
                      "Literal": "?-> c"
                    }
                  ]
                },
                "span": {
                  "start": 44,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 53
          }
        }
      },
      "span": {
        "start": 39,
        "end": 54
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
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 67,
                                  "end": 69
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "c"
                                },
                                "span": {
                                  "start": 72,
                                  "end": 73
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 67,
                            "end": 73
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 60,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 77
          }
        }
      },
      "span": {
        "start": 55,
        "end": 78
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
                  "start": 79,
                  "end": 81
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 85,
                                "end": 87
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "c"
                              },
                              "span": {
                                "start": 90,
                                "end": 91
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 85,
                          "end": 91
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 84,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 92
          }
        }
      },
      "span": {
        "start": 79,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}

===source===
<?php
C::public( set );
C:: public (set);
C::public(set: 1);
$o->public(set);
$o?->private(set);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 9,
                  "end": 15
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 20
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
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
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 25
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 28,
                  "end": 34
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 36,
                            "end": 39
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 39
                      }
                    }
                  },
                  "span": {
                    "start": 36,
                    "end": 39
                  }
                }
              ]
            }
          },
          "span": {
            "start": 24,
            "end": 40
          }
        }
      },
      "span": {
        "start": 24,
        "end": 41
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
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  }
                },
                "span": {
                  "start": 42,
                  "end": 43
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 45,
                  "end": 51
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "set"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 52,
                      "end": 55
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 57,
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 58
                  }
                }
              ]
            }
          },
          "span": {
            "start": 42,
            "end": 59
          }
        }
      },
      "span": {
        "start": 42,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 61,
                  "end": 63
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 65,
                  "end": 71
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 72,
                            "end": 75
                          }
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 75
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 75
                  }
                }
              ]
            }
          },
          "span": {
            "start": 61,
            "end": 76
          }
        }
      },
      "span": {
        "start": 61,
        "end": 77
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 78,
                  "end": 80
                }
              },
              "method": {
                "kind": {
                  "Identifier": "private"
                },
                "span": {
                  "start": 83,
                  "end": 90
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 91,
                            "end": 94
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 94
                      }
                    }
                  },
                  "span": {
                    "start": 91,
                    "end": 94
                  }
                }
              ]
            }
          },
          "span": {
            "start": 78,
            "end": 95
          }
        }
      },
      "span": {
        "start": 78,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}

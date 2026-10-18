===source===
<?php
$x = $a[];
echo $a[][0];
isset($a[]);
foreach ($a[] as $b) {}
$c ??= $a[];
$x = [&$a[]];
f([$a[]]);
unset($a[]['k']);
===errors===
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for unsetting
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 11,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 22,
                          "end": 24
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 22,
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
              "start": 22,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 17,
        "end": 30
      }
    },
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 37,
                  "end": 41
                }
              }
            ]
          },
          "span": {
            "start": 31,
            "end": 42
          }
        }
      },
      "span": {
        "start": 31,
        "end": 43
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 53,
                    "end": 55
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 53,
              "end": 57
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 61,
              "end": 63
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 65,
              "end": 67
            }
          }
        }
      },
      "span": {
        "start": 44,
        "end": 67
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 68,
                  "end": 70
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 75,
                        "end": 77
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 75,
                  "end": 79
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 79
          }
        }
      },
      "span": {
        "start": 68,
        "end": 80
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
                  "start": 81,
                  "end": 83
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
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 88,
                                "end": 90
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 88,
                          "end": 92
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 87,
                        "end": 92
                      }
                    }
                  ]
                },
                "span": {
                  "start": 86,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 81,
            "end": 93
          }
        }
      },
      "span": {
        "start": 81,
        "end": 94
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
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 95,
                      "end": 96
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 96
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 98,
                                    "end": 100
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 98,
                              "end": 102
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 98,
                            "end": 102
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 97,
                      "end": 103
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 97,
                    "end": 103
                  }
                }
              ]
            }
          },
          "span": {
            "start": 95,
            "end": 104
          }
        }
      },
      "span": {
        "start": 95,
        "end": 105
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 112,
                          "end": 114
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 112,
                    "end": 116
                  }
                },
                "index": {
                  "kind": {
                    "String": "k"
                  },
                  "span": {
                    "start": 117,
                    "end": 120
                  }
                }
              }
            },
            "span": {
              "start": 112,
              "end": 121
            }
          }
        ]
      },
      "span": {
        "start": 106,
        "end": 123
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123
  }
}

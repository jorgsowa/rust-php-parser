===source===
<?php
early($arr[]);
function early($v) {}
function test(&$var) {}
test($arr[]);
function refs($a, &...$rest) {}
refs($a, $b[], $c[]);
if (true) {
    function conditional($v) {}
}
conditional($arr[]);
unknown($arr[]);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "early"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 12,
                              "end": 16
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 18
                  }
                }
              ]
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
        "Function": {
          "name": {
            "name": "early",
            "span": {
              "start": 30,
              "end": 35
            }
          },
          "params": [
            {
              "name": {
                "name": "v",
                "span": {
                  "start": 36,
                  "end": 38
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 36,
                "end": 38
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 42
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 52,
              "end": 56
            }
          },
          "params": [
            {
              "name": {
                "name": "var",
                "span": {
                  "start": 58,
                  "end": 62
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 57,
                "end": 62
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 66
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
                      "test"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 67,
                      "end": 71
                    }
                  }
                },
                "span": {
                  "start": 67,
                  "end": 71
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 72,
                              "end": 76
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 78
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 78
                  }
                }
              ]
            }
          },
          "span": {
            "start": 67,
            "end": 79
          }
        }
      },
      "span": {
        "start": 67,
        "end": 80
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "refs",
            "span": {
              "start": 90,
              "end": 94
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 95,
                  "end": 97
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 95,
                "end": 97
              }
            },
            {
              "name": {
                "name": "rest",
                "span": {
                  "start": 103,
                  "end": 108
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 99,
                "end": 108
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 81,
        "end": 112
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
                      "refs"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 113,
                      "end": 117
                    }
                  }
                },
                "span": {
                  "start": 113,
                  "end": 117
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 118,
                        "end": 120
                      }
                    }
                  },
                  "span": {
                    "start": 118,
                    "end": 120
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 122,
                              "end": 124
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 122,
                        "end": 126
                      }
                    }
                  },
                  "span": {
                    "start": 122,
                    "end": 126
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 128,
                              "end": 130
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 128,
                        "end": 132
                      }
                    }
                  },
                  "span": {
                    "start": 128,
                    "end": 132
                  }
                }
              ]
            }
          },
          "span": {
            "start": 113,
            "end": 133
          }
        }
      },
      "span": {
        "start": 113,
        "end": 134
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 139,
              "end": 143
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Function": {
                      "name": {
                        "name": "conditional",
                        "span": {
                          "start": 160,
                          "end": 171
                        }
                      },
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 172,
                              "end": 174
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 172,
                            "end": 174
                          }
                        }
                      ],
                      "body": [],
                      "return_type": null,
                      "by_ref": false,
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 151,
                    "end": 178
                  }
                }
              ]
            },
            "span": {
              "start": 145,
              "end": 180
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 135,
        "end": 180
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
                      "conditional"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 181,
                      "end": 192
                    }
                  }
                },
                "span": {
                  "start": 181,
                  "end": 192
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 193,
                              "end": 197
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 193,
                        "end": 199
                      }
                    }
                  },
                  "span": {
                    "start": 193,
                    "end": 199
                  }
                }
              ]
            }
          },
          "span": {
            "start": 181,
            "end": 200
          }
        }
      },
      "span": {
        "start": 181,
        "end": 201
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
                      "unknown"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 202,
                      "end": 209
                    }
                  }
                },
                "span": {
                  "start": 202,
                  "end": 209
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 210,
                              "end": 214
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 210,
                        "end": 216
                      }
                    }
                  },
                  "span": {
                    "start": 210,
                    "end": 216
                  }
                }
              ]
            }
          },
          "span": {
            "start": 202,
            "end": 217
          }
        }
      },
      "span": {
        "start": 202,
        "end": 218
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 218
  }
}

===source===
<?php
($a)[0] = 1;
($a)->b = 1;
[($a)] = $c;
$x = &f();
$x = [&$a, "k" => &$b[0], &$c->d, &A::$e];
[$a, [$b, , $c]] = $d;
[&$a, [&$b]] = $c;
unset($a, $b[0], $c->d, A::$e,);
foreach ($a as $k => [$x, , [$y]]) {}
foreach ($a as A::$p => &$o[0]) {}
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 10
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 20,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 23
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 25,
                        "end": 26
                      }
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 29,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 30
          }
        }
      },
      "span": {
        "start": 19,
        "end": 31
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 34,
                                "end": 36
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 37
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 41,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 43
          }
        }
      },
      "span": {
        "start": 32,
        "end": 44
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
                  "start": 45,
                  "end": 47
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
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 51,
                            "end": 52
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 52
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 51,
                  "end": 54
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 45,
            "end": 54
          }
        }
      },
      "span": {
        "start": 45,
        "end": 55
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
                  "start": 56,
                  "end": 58
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 65
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 67,
                          "end": 70
                        }
                      },
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 75,
                                  "end": 77
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 78,
                                  "end": 79
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 75,
                            "end": 80
                          }
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 80
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 83,
                                  "end": 85
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "d"
                                },
                                "span": {
                                  "start": 87,
                                  "end": 88
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 83,
                            "end": 88
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 88
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 91,
                                      "end": 92
                                    }
                                  }
                                },
                                "span": {
                                  "start": 91,
                                  "end": 92
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "e"
                                },
                                "span": {
                                  "start": 94,
                                  "end": 96
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 91,
                            "end": 96
                          }
                        }
                      },
                      "span": {
                        "start": 90,
                        "end": 96
                      }
                    }
                  ]
                },
                "span": {
                  "start": 61,
                  "end": 97
                }
              }
            }
          },
          "span": {
            "start": 56,
            "end": 97
          }
        }
      },
      "span": {
        "start": 56,
        "end": 98
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 100,
                            "end": 102
                          }
                        }
                      },
                      "span": {
                        "start": 100,
                        "end": 102
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
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
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": "Omit",
                                    "span": {
                                      "start": 109,
                                      "end": 110
                                    }
                                  }
                                },
                                "span": {
                                  "start": 109,
                                  "end": 110
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "c"
                                    },
                                    "span": {
                                      "start": 111,
                                      "end": 113
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 113
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 104,
                            "end": 114
                          }
                        }
                      },
                      "span": {
                        "start": 104,
                        "end": 114
                      }
                    }
                  ]
                },
                "span": {
                  "start": 99,
                  "end": 115
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 118,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 99,
            "end": 120
          }
        }
      },
      "span": {
        "start": 99,
        "end": 121
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 124,
                            "end": 126
                          }
                        }
                      },
                      "span": {
                        "start": 123,
                        "end": 126
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "ByRef": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 130,
                                      "end": 132
                                    }
                                  }
                                },
                                "span": {
                                  "start": 129,
                                  "end": 132
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 128,
                            "end": 133
                          }
                        }
                      },
                      "span": {
                        "start": 128,
                        "end": 133
                      }
                    }
                  ]
                },
                "span": {
                  "start": 122,
                  "end": 134
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 137,
                  "end": 139
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 139
          }
        }
      },
      "span": {
        "start": 122,
        "end": 140
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 147,
              "end": 149
            }
          },
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 151,
                    "end": 153
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 154,
                    "end": 155
                  }
                }
              }
            },
            "span": {
              "start": 151,
              "end": 156
            }
          },
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "c"
                  },
                  "span": {
                    "start": 158,
                    "end": 160
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "d"
                  },
                  "span": {
                    "start": 162,
                    "end": 163
                  }
                }
              }
            },
            "span": {
              "start": 158,
              "end": 163
            }
          },
          {
            "kind": {
              "StaticPropertyAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 165,
                        "end": 166
                      }
                    }
                  },
                  "span": {
                    "start": 165,
                    "end": 166
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "e"
                  },
                  "span": {
                    "start": 168,
                    "end": 170
                  }
                }
              }
            },
            "span": {
              "start": 165,
              "end": 170
            }
          }
        ]
      },
      "span": {
        "start": 141,
        "end": 173
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 183,
              "end": 185
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 189,
              "end": 191
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 196,
                        "end": 198
                      }
                    }
                  },
                  "span": {
                    "start": 196,
                    "end": 198
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": "Omit",
                      "span": {
                        "start": 200,
                        "end": 201
                      }
                    }
                  },
                  "span": {
                    "start": 200,
                    "end": 201
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "y"
                                },
                                "span": {
                                  "start": 203,
                                  "end": 205
                                }
                              }
                            },
                            "span": {
                              "start": 203,
                              "end": 205
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 202,
                        "end": 206
                      }
                    }
                  },
                  "span": {
                    "start": 202,
                    "end": 206
                  }
                }
              ]
            },
            "span": {
              "start": 195,
              "end": 207
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 209,
              "end": 211
            }
          }
        }
      },
      "span": {
        "start": 174,
        "end": 211
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 221,
              "end": 223
            }
          },
          "key": {
            "kind": {
              "StaticPropertyAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 227,
                        "end": 228
                      }
                    }
                  },
                  "span": {
                    "start": 227,
                    "end": 228
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "p"
                  },
                  "span": {
                    "start": 230,
                    "end": 232
                  }
                }
              }
            },
            "span": {
              "start": 227,
              "end": 232
            }
          },
          "value": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "o"
                  },
                  "span": {
                    "start": 237,
                    "end": 239
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 240,
                    "end": 241
                  }
                }
              }
            },
            "span": {
              "start": 237,
              "end": 242
            }
          },
          "by_ref": true,
          "by_ref_span": {
            "start": 236,
            "end": 237
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 244,
              "end": 246
            }
          }
        }
      },
      "span": {
        "start": 212,
        "end": 246
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 246
  }
}

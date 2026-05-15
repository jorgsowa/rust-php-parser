===source===
<?php
// Comments in array destructuring
[/* first */ $a, // second
$b, /* third */ $c] = $arr;

// Comments in list() form
list(
  /* a */ $x,
  // b
  $y,
  /* c */ $z
) = $values;

// Comments with keys
[
  /* key1 */ 'name' => $name,
  // key2
  'age' => $age,
  /* key3 */ 'email' => $email
] = $data;

// Mixed numeric and string keys with comments
[
  /* index 0 */ 0 => $first,
  // index 1
  1 => $second,
  /* key */ 'third' => $third
] = $mixed;

// Nested destructuring with comments
[
  /* outer */ [/* inner */ $a, $b],
  // another
  $c
] = $nested;

// Nested destructuring in foreach
foreach ($items as /* item */ [/* name */ $name, // value
$value]) {
  echo $name;
}

// Destructuring with references and comments
[/* ref */ &$ref, // regular
$normal] = $arr;

// Skip elements with comments
[
  /* first */ $a,
  // skip
  ,
  /* third */ $c
] = $data;

// Multiple skip with comments
[
  $first,
  , // skip second
  , // skip third
  $fourth
] = $arr;

// Comments in nested list
list(
  /* outer */ list(/* inner */ $a, $b),
  // next
  $c
) = $nested;

// Complex nested with comments
[
  /* level1 */ [
    /* level2 */ $a,
    // level2 continued
    $b
  ],
  // level1 next
  [
    /* more */ $c,
    $d
  ]
] = $complex;

// Trailing comma with comment
[
  $a,
  // comment
  $b,
] = $arr;

// Hash comments in destructuring
[
  $a,
  # hash comment
  $b,
  # another
  $c
] = $data;
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 54,
                          "end": 56
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 54,
                        "end": 56
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 68,
                          "end": 70
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 68,
                        "end": 70
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 84,
                          "end": 86
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 84,
                        "end": 86
                      }
                    }
                  ]
                },
                "span": {
                  "start": 41,
                  "end": 87
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 90,
                  "end": 94
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 94
          }
        }
      },
      "span": {
        "start": 41,
        "end": 95
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
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 140,
                          "end": 142
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 140,
                        "end": 142
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "y"
                        },
                        "span": {
                          "start": 153,
                          "end": 155
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 153,
                        "end": 155
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "z"
                        },
                        "span": {
                          "start": 167,
                          "end": 169
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 167,
                        "end": 169
                      }
                    }
                  ]
                },
                "span": {
                  "start": 124,
                  "end": 171
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "values"
                },
                "span": {
                  "start": 174,
                  "end": 181
                }
              }
            }
          },
          "span": {
            "start": 124,
            "end": 181
          }
        }
      },
      "span": {
        "start": 124,
        "end": 182
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
                      "key": {
                        "kind": {
                          "String": "name"
                        },
                        "span": {
                          "start": 221,
                          "end": 227
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 231,
                          "end": 236
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 221,
                        "end": 236
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "age"
                        },
                        "span": {
                          "start": 250,
                          "end": 255
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "age"
                        },
                        "span": {
                          "start": 259,
                          "end": 263
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 250,
                        "end": 263
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "email"
                        },
                        "span": {
                          "start": 278,
                          "end": 285
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "email"
                        },
                        "span": {
                          "start": 289,
                          "end": 295
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 278,
                        "end": 295
                      }
                    }
                  ]
                },
                "span": {
                  "start": 206,
                  "end": 297
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 300,
                  "end": 305
                }
              }
            }
          },
          "span": {
            "start": 206,
            "end": 305
          }
        }
      },
      "span": {
        "start": 206,
        "end": 306
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
                      "key": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 373,
                          "end": 374
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "first"
                        },
                        "span": {
                          "start": 378,
                          "end": 384
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 373,
                        "end": 384
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 401,
                          "end": 402
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "second"
                        },
                        "span": {
                          "start": 406,
                          "end": 413
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 401,
                        "end": 413
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "third"
                        },
                        "span": {
                          "start": 427,
                          "end": 434
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "third"
                        },
                        "span": {
                          "start": 438,
                          "end": 444
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 427,
                        "end": 444
                      }
                    }
                  ]
                },
                "span": {
                  "start": 355,
                  "end": 446
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "mixed"
                },
                "span": {
                  "start": 449,
                  "end": 455
                }
              }
            }
          },
          "span": {
            "start": 355,
            "end": 455
          }
        }
      },
      "span": {
        "start": 355,
        "end": 456
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
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 525,
                                  "end": 527
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 525,
                                "end": 527
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 529,
                                  "end": 531
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 529,
                                "end": 531
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 512,
                          "end": 532
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 512,
                        "end": 532
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 549,
                          "end": 551
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 549,
                        "end": 551
                      }
                    }
                  ]
                },
                "span": {
                  "start": 496,
                  "end": 553
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "nested"
                },
                "span": {
                  "start": 556,
                  "end": 563
                }
              }
            }
          },
          "span": {
            "start": 496,
            "end": 563
          }
        }
      },
      "span": {
        "start": 496,
        "end": 564
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 610,
              "end": 616
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "name"
                    },
                    "span": {
                      "start": 643,
                      "end": 648
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 643,
                    "end": 648
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "value"
                    },
                    "span": {
                      "start": 659,
                      "end": 665
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 659,
                    "end": 665
                  }
                }
              ]
            },
            "span": {
              "start": 631,
              "end": 666
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 677,
                          "end": 682
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 672,
                    "end": 683
                  }
                }
              ]
            },
            "span": {
              "start": 668,
              "end": 685
            }
          }
        }
      },
      "span": {
        "start": 601,
        "end": 685
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
                      "value": {
                        "kind": {
                          "Variable": "ref"
                        },
                        "span": {
                          "start": 745,
                          "end": 749
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 744,
                        "end": 749
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "normal"
                        },
                        "span": {
                          "start": 762,
                          "end": 769
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 762,
                        "end": 769
                      }
                    }
                  ]
                },
                "span": {
                  "start": 733,
                  "end": 770
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 773,
                  "end": 777
                }
              }
            }
          },
          "span": {
            "start": 733,
            "end": 777
          }
        }
      },
      "span": {
        "start": 733,
        "end": 778
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 827,
                          "end": 829
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 827,
                        "end": 829
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 843,
                          "end": 844
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 843,
                        "end": 844
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 859,
                          "end": 861
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 859,
                        "end": 861
                      }
                    }
                  ]
                },
                "span": {
                  "start": 811,
                  "end": 863
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 866,
                  "end": 871
                }
              }
            }
          },
          "span": {
            "start": 811,
            "end": 871
          }
        }
      },
      "span": {
        "start": 811,
        "end": 872
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
                      "value": {
                        "kind": {
                          "Variable": "first"
                        },
                        "span": {
                          "start": 909,
                          "end": 915
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 909,
                        "end": 915
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 919,
                          "end": 920
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 919,
                        "end": 920
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 938,
                          "end": 939
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 938,
                        "end": 939
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "fourth"
                        },
                        "span": {
                          "start": 956,
                          "end": 963
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 956,
                        "end": 963
                      }
                    }
                  ]
                },
                "span": {
                  "start": 905,
                  "end": 965
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 968,
                  "end": 972
                }
              }
            }
          },
          "span": {
            "start": 905,
            "end": 972
          }
        }
      },
      "span": {
        "start": 905,
        "end": 973
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
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 1039,
                                  "end": 1041
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 1039,
                                "end": 1041
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 1043,
                                  "end": 1045
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 1043,
                                "end": 1045
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1022,
                          "end": 1046
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1022,
                        "end": 1046
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 1060,
                          "end": 1062
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1060,
                        "end": 1062
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1002,
                  "end": 1064
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "nested"
                },
                "span": {
                  "start": 1067,
                  "end": 1074
                }
              }
            }
          },
          "span": {
            "start": 1002,
            "end": 1074
          }
        }
      },
      "span": {
        "start": 1002,
        "end": 1075
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
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 1145,
                                  "end": 1147
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 1145,
                                "end": 1147
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 1177,
                                  "end": 1179
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 1177,
                                "end": 1179
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1126,
                          "end": 1183
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1126,
                        "end": 1183
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 1221,
                                  "end": 1223
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 1221,
                                "end": 1223
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 1229,
                                  "end": 1231
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 1229,
                                "end": 1231
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1204,
                          "end": 1235
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1204,
                        "end": 1235
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1109,
                  "end": 1237
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "complex"
                },
                "span": {
                  "start": 1240,
                  "end": 1248
                }
              }
            }
          },
          "span": {
            "start": 1109,
            "end": 1248
          }
        }
      },
      "span": {
        "start": 1109,
        "end": 1249
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 1286,
                          "end": 1288
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1286,
                        "end": 1288
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 1305,
                          "end": 1307
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1305,
                        "end": 1307
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1282,
                  "end": 1310
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 1313,
                  "end": 1317
                }
              }
            }
          },
          "span": {
            "start": 1282,
            "end": 1317
          }
        }
      },
      "span": {
        "start": 1282,
        "end": 1318
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 1358,
                          "end": 1360
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1358,
                        "end": 1360
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 1381,
                          "end": 1383
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1381,
                        "end": 1383
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 1399,
                          "end": 1401
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 1399,
                        "end": 1401
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1354,
                  "end": 1403
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 1406,
                  "end": 1411
                }
              }
            }
          },
          "span": {
            "start": 1354,
            "end": 1411
          }
        }
      },
      "span": {
        "start": 1354,
        "end": 1412
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1412
  }
}

===source===
<?php
while (true) {
    goto out;
}
out:
while (true) {
    inner:
    while (true) {
        goto inner;
    }
}
if (true) {
    branch:
}
goto branch;
declare(ticks=1) {
    declared:
}
goto declared;
try {
    goto after;
} finally {
    goto local;
    local:
    while (true) {
        break;
    }
    foreach ([] as $v) {
        continue;
    }
    switch (1) {
        case 1:
            break;
    }
    try {
        goto local;
    } finally {
    }
}
after:
try {
    caught:
} catch (Exception $e) {
    goto caught;
}
goto tried;
try {
    tried:
} finally {
}
while (true) {
    try {
    } finally {
        return;
    }
}
caseSensitive:
CaseSensitive:
function f() {
    out:
    goto out;
}
class C {
    public int $p {
        get {
            out:
            goto out;
        }
    }
    public function m() {
        out:
        goto out;
    }
}
$f = function () {
    out:
    goto out;
};
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 64
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 64
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 13,
              "end": 17
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Goto": {
                      "name": "out",
                      "span": {
                        "start": 30,
                        "end": 33
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 34
                  }
                }
              ]
            },
            "span": {
              "start": 19,
              "end": 36
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Label": {
          "name": "out",
          "span": {
            "start": 37,
            "end": 40
          }
        }
      },
      "span": {
        "start": 37,
        "end": 41
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 49,
              "end": 53
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "inner",
                      "span": {
                        "start": 61,
                        "end": 66
                      }
                    }
                  },
                  "span": {
                    "start": 61,
                    "end": 67
                  }
                },
                {
                  "kind": {
                    "While": {
                      "condition": {
                        "kind": {
                          "Bool": true
                        },
                        "span": {
                          "start": 79,
                          "end": 83
                        }
                      },
                      "body": {
                        "kind": {
                          "Block": [
                            {
                              "kind": {
                                "Goto": {
                                  "name": "inner",
                                  "span": {
                                    "start": 100,
                                    "end": 105
                                  }
                                }
                              },
                              "span": {
                                "start": 95,
                                "end": 106
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 85,
                          "end": 112
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 112
                  }
                }
              ]
            },
            "span": {
              "start": 55,
              "end": 114
            }
          }
        }
      },
      "span": {
        "start": 42,
        "end": 114
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
              "start": 119,
              "end": 123
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "branch",
                      "span": {
                        "start": 131,
                        "end": 137
                      }
                    }
                  },
                  "span": {
                    "start": 131,
                    "end": 138
                  }
                }
              ]
            },
            "span": {
              "start": 125,
              "end": 140
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 115,
        "end": 140
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "branch",
          "span": {
            "start": 146,
            "end": 152
          }
        }
      },
      "span": {
        "start": 141,
        "end": 153
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 168,
                  "end": 169
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "declared",
                      "span": {
                        "start": 177,
                        "end": 185
                      }
                    }
                  },
                  "span": {
                    "start": 177,
                    "end": 186
                  }
                }
              ]
            },
            "span": {
              "start": 171,
              "end": 188
            }
          }
        }
      },
      "span": {
        "start": 154,
        "end": 188
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "declared",
          "span": {
            "start": 194,
            "end": 202
          }
        }
      },
      "span": {
        "start": 189,
        "end": 203
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Goto": {
                  "name": "after",
                  "span": {
                    "start": 219,
                    "end": 224
                  }
                }
              },
              "span": {
                "start": 214,
                "end": 225
              }
            }
          ],
          "catches": [],
          "finally": [
            {
              "kind": {
                "Goto": {
                  "name": "local",
                  "span": {
                    "start": 247,
                    "end": 252
                  }
                }
              },
              "span": {
                "start": 242,
                "end": 253
              }
            },
            {
              "kind": {
                "Label": {
                  "name": "local",
                  "span": {
                    "start": 258,
                    "end": 263
                  }
                }
              },
              "span": {
                "start": 258,
                "end": 264
              }
            },
            {
              "kind": {
                "While": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 276,
                      "end": 280
                    }
                  },
                  "body": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Break": null
                          },
                          "span": {
                            "start": 292,
                            "end": 298
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 282,
                      "end": 304
                    }
                  }
                }
              },
              "span": {
                "start": 269,
                "end": 304
              }
            },
            {
              "kind": {
                "Foreach": {
                  "expr": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 318,
                      "end": 320
                    }
                  },
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "v"
                    },
                    "span": {
                      "start": 324,
                      "end": 326
                    }
                  },
                  "body": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Continue": null
                          },
                          "span": {
                            "start": 338,
                            "end": 347
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 328,
                      "end": 353
                    }
                  }
                }
              },
              "span": {
                "start": 309,
                "end": 353
              }
            },
            {
              "kind": {
                "Switch": {
                  "expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 366,
                      "end": 367
                    }
                  },
                  "cases": [
                    {
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 384,
                          "end": 385
                        }
                      },
                      "body": [
                        {
                          "kind": {
                            "Break": null
                          },
                          "span": {
                            "start": 399,
                            "end": 405
                          }
                        }
                      ],
                      "span": {
                        "start": 379,
                        "end": 405
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 358,
                "end": 411
              }
            },
            {
              "kind": {
                "TryCatch": {
                  "body": [
                    {
                      "kind": {
                        "Goto": {
                          "name": "local",
                          "span": {
                            "start": 435,
                            "end": 440
                          }
                        }
                      },
                      "span": {
                        "start": 430,
                        "end": 441
                      }
                    }
                  ],
                  "catches": [],
                  "finally": []
                }
              },
              "span": {
                "start": 416,
                "end": 463
              }
            }
          ]
        }
      },
      "span": {
        "start": 204,
        "end": 465
      }
    },
    {
      "kind": {
        "Label": {
          "name": "after",
          "span": {
            "start": 466,
            "end": 471
          }
        }
      },
      "span": {
        "start": 466,
        "end": 472
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Label": {
                  "name": "caught",
                  "span": {
                    "start": 483,
                    "end": 489
                  }
                }
              },
              "span": {
                "start": 483,
                "end": 490
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 500,
                    "end": 509
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 510,
                  "end": 512
                }
              },
              "body": [
                {
                  "kind": {
                    "Goto": {
                      "name": "caught",
                      "span": {
                        "start": 525,
                        "end": 531
                      }
                    }
                  },
                  "span": {
                    "start": 520,
                    "end": 532
                  }
                }
              ],
              "span": {
                "start": 499,
                "end": 534
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 473,
        "end": 534
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "tried",
          "span": {
            "start": 540,
            "end": 545
          }
        }
      },
      "span": {
        "start": 535,
        "end": 546
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Label": {
                  "name": "tried",
                  "span": {
                    "start": 557,
                    "end": 562
                  }
                }
              },
              "span": {
                "start": 557,
                "end": 563
              }
            }
          ],
          "catches": [],
          "finally": []
        }
      },
      "span": {
        "start": 547,
        "end": 577
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 585,
              "end": 589
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "TryCatch": {
                      "body": [],
                      "catches": [],
                      "finally": [
                        {
                          "kind": {
                            "Return": null
                          },
                          "span": {
                            "start": 627,
                            "end": 634
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 597,
                    "end": 640
                  }
                }
              ]
            },
            "span": {
              "start": 591,
              "end": 642
            }
          }
        }
      },
      "span": {
        "start": 578,
        "end": 642
      }
    },
    {
      "kind": {
        "Label": {
          "name": "caseSensitive",
          "span": {
            "start": 643,
            "end": 656
          }
        }
      },
      "span": {
        "start": 643,
        "end": 657
      }
    },
    {
      "kind": {
        "Label": {
          "name": "CaseSensitive",
          "span": {
            "start": 658,
            "end": 671
          }
        }
      },
      "span": {
        "start": 658,
        "end": 672
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 682,
              "end": 683
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Label": {
                  "name": "out",
                  "span": {
                    "start": 692,
                    "end": 695
                  }
                }
              },
              "span": {
                "start": 692,
                "end": 696
              }
            },
            {
              "kind": {
                "Goto": {
                  "name": "out",
                  "span": {
                    "start": 706,
                    "end": 709
                  }
                }
              },
              "span": {
                "start": 701,
                "end": 710
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 673,
        "end": 712
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 719,
              "end": 720
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
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 738,
                      "end": 740
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 734,
                          "end": 737
                        }
                      }
                    },
                    "span": {
                      "start": 734,
                      "end": 737
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Label": {
                                "name": "out",
                                "span": {
                                  "start": 769,
                                  "end": 772
                                }
                              }
                            },
                            "span": {
                              "start": 769,
                              "end": 773
                            }
                          },
                          {
                            "kind": {
                              "Goto": {
                                "name": "out",
                                "span": {
                                  "start": 791,
                                  "end": 794
                                }
                              }
                            },
                            "span": {
                              "start": 786,
                              "end": 795
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 751,
                        "end": 805
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 727,
                "end": 811
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 832,
                      "end": 833
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Label": {
                          "name": "out",
                          "span": {
                            "start": 846,
                            "end": 849
                          }
                        }
                      },
                      "span": {
                        "start": 846,
                        "end": 850
                      }
                    },
                    {
                      "kind": {
                        "Goto": {
                          "name": "out",
                          "span": {
                            "start": 864,
                            "end": 867
                          }
                        }
                      },
                      "span": {
                        "start": 859,
                        "end": 868
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 816,
                "end": 874
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 713,
        "end": 876
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 877,
                  "end": 879
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Label": {
                            "name": "out",
                            "span": {
                              "start": 900,
                              "end": 903
                            }
                          }
                        },
                        "span": {
                          "start": 900,
                          "end": 904
                        }
                      },
                      {
                        "kind": {
                          "Goto": {
                            "name": "out",
                            "span": {
                              "start": 914,
                              "end": 917
                            }
                          }
                        },
                        "span": {
                          "start": 909,
                          "end": 918
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 882,
                  "end": 920
                }
              }
            }
          },
          "span": {
            "start": 877,
            "end": 920
          }
        }
      },
      "span": {
        "start": 877,
        "end": 921
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 921
  }
}

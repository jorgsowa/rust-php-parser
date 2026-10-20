===source===
<?php
namespace App\Enums;

enum Priority: int
{
    case Low = 1;
    case Medium = 2;
    case High = 3;
    case Critical = 4;

    public function label(): string
    {
        return match ($this) {
            Priority::Low => 'Low Priority',
            Priority::Medium => 'Medium Priority',
            Priority::High => 'High Priority',
            Priority::Critical => 'Critical Priority',
        };
    }

    public static function fromLabel(string $label): self
    {
        static $map = null;
        return static::Critical;
    }
}

class TaskService
{
    private static int $counter = 0;

    public static function create(string $title, Priority $priority): array
    {
        self::$counter++;
        $id = self::$counter;
        $formatter = static fn(string $t, int $i): string => $t . '#' . $i;
        $formatted = $formatter($title, $id);
        return [
            'id' => $id,
            'title' => $formatted,
            'priority' => $priority->label(),
            'is_urgent' => $priority === Priority::Critical || $priority === Priority::High,
        ];
    }
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Priority" in Standard input code on line 4
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Enums"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 25
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Priority",
            "span": {
              "start": 33,
              "end": 41
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 43,
              "end": 46
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Low",
                    "span": {
                      "start": 58,
                      "end": 61
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 53,
                "end": 66
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Medium",
                    "span": {
                      "start": 76,
                      "end": 82
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 85,
                      "end": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 87
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "High",
                    "span": {
                      "start": 97,
                      "end": 101
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 104,
                      "end": 105
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 106
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Critical",
                    "span": {
                      "start": 116,
                      "end": 124
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 127,
                      "end": 128
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 111,
                "end": 129
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "label",
                    "span": {
                      "start": 151,
                      "end": 156
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 160,
                          "end": 166
                        }
                      }
                    },
                    "span": {
                      "start": 160,
                      "end": 166
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Match": {
                              "subject": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 195,
                                  "end": 200
                                }
                              },
                              "arms": [
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "Priority"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 216,
                                                  "end": 224
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 216,
                                              "end": 224
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "Low"
                                            },
                                            "span": {
                                              "start": 226,
                                              "end": 229
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 216,
                                        "end": 229
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "Low Priority"
                                    },
                                    "span": {
                                      "start": 233,
                                      "end": 247
                                    }
                                  },
                                  "span": {
                                    "start": 216,
                                    "end": 247
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "Priority"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 261,
                                                  "end": 269
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 261,
                                              "end": 269
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "Medium"
                                            },
                                            "span": {
                                              "start": 271,
                                              "end": 277
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 261,
                                        "end": 277
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "Medium Priority"
                                    },
                                    "span": {
                                      "start": 281,
                                      "end": 298
                                    }
                                  },
                                  "span": {
                                    "start": 261,
                                    "end": 298
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "Priority"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 312,
                                                  "end": 320
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 312,
                                              "end": 320
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "High"
                                            },
                                            "span": {
                                              "start": 322,
                                              "end": 326
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 312,
                                        "end": 326
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "High Priority"
                                    },
                                    "span": {
                                      "start": 330,
                                      "end": 345
                                    }
                                  },
                                  "span": {
                                    "start": 312,
                                    "end": 345
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "Priority"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 359,
                                                  "end": 367
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 359,
                                              "end": 367
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "Critical"
                                            },
                                            "span": {
                                              "start": 369,
                                              "end": 377
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 359,
                                        "end": 377
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "Critical Priority"
                                    },
                                    "span": {
                                      "start": 381,
                                      "end": 400
                                    }
                                  },
                                  "span": {
                                    "start": 359,
                                    "end": 400
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 188,
                            "end": 411
                          }
                        }
                      },
                      "span": {
                        "start": 181,
                        "end": 412
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 135,
                "end": 418
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "fromLabel",
                    "span": {
                      "start": 447,
                      "end": 456
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "label",
                        "span": {
                          "start": 464,
                          "end": 470
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 457,
                              "end": 463
                            }
                          }
                        },
                        "span": {
                          "start": 457,
                          "end": 463
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 457,
                        "end": 470
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 473,
                          "end": 477
                        }
                      }
                    },
                    "span": {
                      "start": 473,
                      "end": 477
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "map",
                              "span": {
                                "start": 499,
                                "end": 503
                              }
                            },
                            "default": {
                              "kind": "Null",
                              "span": {
                                "start": 506,
                                "end": 510
                              }
                            },
                            "span": {
                              "start": 499,
                              "end": 510
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 492,
                        "end": 511
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "static"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 527,
                                      "end": 533
                                    }
                                  }
                                },
                                "span": {
                                  "start": 527,
                                  "end": 533
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "Critical"
                                },
                                "span": {
                                  "start": 535,
                                  "end": 543
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 527,
                            "end": 543
                          }
                        }
                      },
                      "span": {
                        "start": 520,
                        "end": 544
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 424,
                "end": 550
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 28,
        "end": 552
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "TaskService",
            "span": {
              "start": 560,
              "end": 571
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
                    "name": "counter",
                    "span": {
                      "start": 597,
                      "end": 605
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 593,
                          "end": 596
                        }
                      }
                    },
                    "span": {
                      "start": 593,
                      "end": 596
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 608,
                      "end": 609
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 578,
                "end": 609
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "create",
                    "span": {
                      "start": 639,
                      "end": 645
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "title",
                        "span": {
                          "start": 653,
                          "end": 659
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 646,
                              "end": 652
                            }
                          }
                        },
                        "span": {
                          "start": 646,
                          "end": 652
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 646,
                        "end": 659
                      }
                    },
                    {
                      "name": {
                        "name": "priority",
                        "span": {
                          "start": 670,
                          "end": 679
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Priority"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 661,
                              "end": 669
                            }
                          }
                        },
                        "span": {
                          "start": 661,
                          "end": 669
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 661,
                        "end": 679
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 682,
                          "end": 687
                        }
                      }
                    },
                    "span": {
                      "start": 682,
                      "end": 687
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "UnaryPostfix": {
                              "operand": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "self"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 702,
                                            "end": 706
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 702,
                                        "end": 706
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "counter"
                                      },
                                      "span": {
                                        "start": 708,
                                        "end": 716
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 702,
                                  "end": 716
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 702,
                            "end": 718
                          }
                        }
                      },
                      "span": {
                        "start": 702,
                        "end": 719
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "id"
                                },
                                "span": {
                                  "start": 728,
                                  "end": 731
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "self"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 734,
                                            "end": 738
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 734,
                                        "end": 738
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "counter"
                                      },
                                      "span": {
                                        "start": 740,
                                        "end": 748
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 734,
                                  "end": 748
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 728,
                            "end": 748
                          }
                        }
                      },
                      "span": {
                        "start": 728,
                        "end": 749
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "formatter"
                                },
                                "span": {
                                  "start": 758,
                                  "end": 768
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "ArrowFunction": {
                                    "is_static": true,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": {
                                          "name": "t",
                                          "span": {
                                            "start": 788,
                                            "end": 790
                                          }
                                        },
                                        "type_hint": {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "string"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 781,
                                                "end": 787
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 781,
                                            "end": 787
                                          }
                                        },
                                        "default": null,
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 781,
                                          "end": 790
                                        }
                                      },
                                      {
                                        "name": {
                                          "name": "i",
                                          "span": {
                                            "start": 796,
                                            "end": 798
                                          }
                                        },
                                        "type_hint": {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "int"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 792,
                                                "end": 795
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 792,
                                            "end": 795
                                          }
                                        },
                                        "default": null,
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 792,
                                          "end": 798
                                        }
                                      }
                                    ],
                                    "return_type": {
                                      "kind": {
                                        "Named": {
                                          "parts": [
                                            "string"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 801,
                                            "end": 807
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 801,
                                        "end": 807
                                      }
                                    },
                                    "body": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Binary": {
                                                "left": {
                                                  "kind": {
                                                    "Variable": "t"
                                                  },
                                                  "span": {
                                                    "start": 811,
                                                    "end": 813
                                                  }
                                                },
                                                "op": "Concat",
                                                "right": {
                                                  "kind": {
                                                    "String": "#"
                                                  },
                                                  "span": {
                                                    "start": 816,
                                                    "end": 819
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 811,
                                              "end": 819
                                            }
                                          },
                                          "op": "Concat",
                                          "right": {
                                            "kind": {
                                              "Variable": "i"
                                            },
                                            "span": {
                                              "start": 822,
                                              "end": 824
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 811,
                                        "end": 824
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 771,
                                  "end": 824
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 758,
                            "end": 824
                          }
                        }
                      },
                      "span": {
                        "start": 758,
                        "end": 825
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "formatted"
                                },
                                "span": {
                                  "start": 834,
                                  "end": 844
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Variable": "formatter"
                                      },
                                      "span": {
                                        "start": 847,
                                        "end": 857
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "title"
                                            },
                                            "span": {
                                              "start": 858,
                                              "end": 864
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 858,
                                          "end": 864
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "id"
                                            },
                                            "span": {
                                              "start": 866,
                                              "end": 869
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 866,
                                          "end": 869
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 847,
                                  "end": 870
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 834,
                            "end": 870
                          }
                        }
                      },
                      "span": {
                        "start": 834,
                        "end": 871
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "id"
                                  },
                                  "span": {
                                    "start": 901,
                                    "end": 905
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "id"
                                    },
                                    "span": {
                                      "start": 909,
                                      "end": 912
                                    }
                                  }
                                },
                                "span": {
                                  "start": 901,
                                  "end": 912
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "title"
                                  },
                                  "span": {
                                    "start": 926,
                                    "end": 933
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "formatted"
                                    },
                                    "span": {
                                      "start": 937,
                                      "end": 947
                                    }
                                  }
                                },
                                "span": {
                                  "start": 926,
                                  "end": 947
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "priority"
                                  },
                                  "span": {
                                    "start": 961,
                                    "end": 971
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "MethodCall": {
                                        "object": {
                                          "kind": {
                                            "Variable": "priority"
                                          },
                                          "span": {
                                            "start": 975,
                                            "end": 984
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "label"
                                          },
                                          "span": {
                                            "start": 986,
                                            "end": 991
                                          }
                                        },
                                        "args": []
                                      }
                                    },
                                    "span": {
                                      "start": 975,
                                      "end": 993
                                    }
                                  }
                                },
                                "span": {
                                  "start": 961,
                                  "end": 993
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "is_urgent"
                                  },
                                  "span": {
                                    "start": 1007,
                                    "end": 1018
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "Variable": "priority"
                                                },
                                                "span": {
                                                  "start": 1022,
                                                  "end": 1031
                                                }
                                              },
                                              "op": "Identical",
                                              "right": {
                                                "kind": {
                                                  "ClassConstAccess": {
                                                    "class": {
                                                      "kind": {
                                                        "Name": {
                                                          "parts": [
                                                            "Priority"
                                                          ],
                                                          "kind": "Unqualified",
                                                          "span": {
                                                            "start": 1036,
                                                            "end": 1044
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1036,
                                                        "end": 1044
                                                      }
                                                    },
                                                    "member": {
                                                      "kind": {
                                                        "Identifier": "Critical"
                                                      },
                                                      "span": {
                                                        "start": 1046,
                                                        "end": 1054
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1036,
                                                  "end": 1054
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1022,
                                            "end": 1054
                                          }
                                        },
                                        "op": "BooleanOr",
                                        "right": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "Variable": "priority"
                                                },
                                                "span": {
                                                  "start": 1058,
                                                  "end": 1067
                                                }
                                              },
                                              "op": "Identical",
                                              "right": {
                                                "kind": {
                                                  "ClassConstAccess": {
                                                    "class": {
                                                      "kind": {
                                                        "Name": {
                                                          "parts": [
                                                            "Priority"
                                                          ],
                                                          "kind": "Unqualified",
                                                          "span": {
                                                            "start": 1072,
                                                            "end": 1080
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1072,
                                                        "end": 1080
                                                      }
                                                    },
                                                    "member": {
                                                      "kind": {
                                                        "Identifier": "High"
                                                      },
                                                      "span": {
                                                        "start": 1082,
                                                        "end": 1086
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1072,
                                                  "end": 1086
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1058,
                                            "end": 1086
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1022,
                                      "end": 1086
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1007,
                                  "end": 1086
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 887,
                            "end": 1097
                          }
                        }
                      },
                      "span": {
                        "start": 880,
                        "end": 1098
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 616,
                "end": 1104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 554,
        "end": 1106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1106
  }
}

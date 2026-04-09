===config===
min_php=8.1
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
===ast===
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
              "end": 25,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Enum": {
          "name": "Priority",
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 43,
              "end": 47,
              "start_line": 4,
              "start_col": 15
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Low",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65,
                      "start_line": 6,
                      "start_col": 15
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 53,
                "end": 71,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Medium",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 85,
                      "end": 86,
                      "start_line": 7,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 92,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "High",
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 104,
                      "end": 105,
                      "start_line": 8,
                      "start_col": 16
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 111,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Critical",
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 127,
                      "end": 128,
                      "start_line": 9,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 111,
                "end": 135,
                "start_line": 9,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "label",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "end": 166,
                          "start_line": 11,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 160,
                      "end": 166,
                      "start_line": 11,
                      "start_col": 29
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
                                  "end": 200,
                                  "start_line": 13,
                                  "start_col": 22
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
                                              "Identifier": "Priority"
                                            },
                                            "span": {
                                              "start": 216,
                                              "end": 224,
                                              "start_line": 14,
                                              "start_col": 12
                                            }
                                          },
                                          "member": "Low"
                                        }
                                      },
                                      "span": {
                                        "start": 216,
                                        "end": 230,
                                        "start_line": 14,
                                        "start_col": 12
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "Low Priority"
                                    },
                                    "span": {
                                      "start": 233,
                                      "end": 247,
                                      "start_line": 14,
                                      "start_col": 29
                                    }
                                  },
                                  "span": {
                                    "start": 216,
                                    "end": 247,
                                    "start_line": 14,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Priority"
                                            },
                                            "span": {
                                              "start": 261,
                                              "end": 269,
                                              "start_line": 15,
                                              "start_col": 12
                                            }
                                          },
                                          "member": "Medium"
                                        }
                                      },
                                      "span": {
                                        "start": 261,
                                        "end": 278,
                                        "start_line": 15,
                                        "start_col": 12
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "Medium Priority"
                                    },
                                    "span": {
                                      "start": 281,
                                      "end": 298,
                                      "start_line": 15,
                                      "start_col": 32
                                    }
                                  },
                                  "span": {
                                    "start": 261,
                                    "end": 298,
                                    "start_line": 15,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Priority"
                                            },
                                            "span": {
                                              "start": 312,
                                              "end": 320,
                                              "start_line": 16,
                                              "start_col": 12
                                            }
                                          },
                                          "member": "High"
                                        }
                                      },
                                      "span": {
                                        "start": 312,
                                        "end": 327,
                                        "start_line": 16,
                                        "start_col": 12
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "High Priority"
                                    },
                                    "span": {
                                      "start": 330,
                                      "end": 345,
                                      "start_line": 16,
                                      "start_col": 30
                                    }
                                  },
                                  "span": {
                                    "start": 312,
                                    "end": 345,
                                    "start_line": 16,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Priority"
                                            },
                                            "span": {
                                              "start": 359,
                                              "end": 367,
                                              "start_line": 17,
                                              "start_col": 12
                                            }
                                          },
                                          "member": "Critical"
                                        }
                                      },
                                      "span": {
                                        "start": 359,
                                        "end": 378,
                                        "start_line": 17,
                                        "start_col": 12
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "Critical Priority"
                                    },
                                    "span": {
                                      "start": 381,
                                      "end": 400,
                                      "start_line": 17,
                                      "start_col": 34
                                    }
                                  },
                                  "span": {
                                    "start": 359,
                                    "end": 400,
                                    "start_line": 17,
                                    "start_col": 12
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 188,
                            "end": 411,
                            "start_line": 13,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 181,
                        "end": 417,
                        "start_line": 13,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 135,
                "end": 424,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "fromLabel",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "label",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 457,
                              "end": 463,
                              "start_line": 21,
                              "start_col": 37
                            }
                          }
                        },
                        "span": {
                          "start": 457,
                          "end": 463,
                          "start_line": 21,
                          "start_col": 37
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 457,
                        "end": 470,
                        "start_line": 21,
                        "start_col": 37
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
                          "end": 477,
                          "start_line": 21,
                          "start_col": 53
                        }
                      }
                    },
                    "span": {
                      "start": 473,
                      "end": 477,
                      "start_line": 21,
                      "start_col": 53
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": "map",
                            "default": {
                              "kind": "Null",
                              "span": {
                                "start": 506,
                                "end": 510,
                                "start_line": 23,
                                "start_col": 22
                              }
                            },
                            "span": {
                              "start": 499,
                              "end": 510,
                              "start_line": 23,
                              "start_col": 15
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 492,
                        "end": 520,
                        "start_line": 23,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "static"
                                },
                                "span": {
                                  "start": 527,
                                  "end": 533,
                                  "start_line": 24,
                                  "start_col": 15
                                }
                              },
                              "member": "Critical"
                            }
                          },
                          "span": {
                            "start": 527,
                            "end": 543,
                            "start_line": 24,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 520,
                        "end": 549,
                        "start_line": 24,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 424,
                "end": 551,
                "start_line": 21,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 28,
        "end": 552,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "TaskService",
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
                  "name": "counter",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 593,
                          "end": 596,
                          "start_line": 30,
                          "start_col": 19
                        }
                      }
                    },
                    "span": {
                      "start": 593,
                      "end": 596,
                      "start_line": 30,
                      "start_col": 19
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 608,
                      "end": 609,
                      "start_line": 30,
                      "start_col": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 578,
                "end": 609,
                "start_line": 30,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "create",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "title",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 646,
                              "end": 652,
                              "start_line": 32,
                              "start_col": 34
                            }
                          }
                        },
                        "span": {
                          "start": 646,
                          "end": 652,
                          "start_line": 32,
                          "start_col": 34
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 646,
                        "end": 659,
                        "start_line": 32,
                        "start_col": 34
                      }
                    },
                    {
                      "name": "priority",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Priority"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 661,
                              "end": 670,
                              "start_line": 32,
                              "start_col": 49
                            }
                          }
                        },
                        "span": {
                          "start": 661,
                          "end": 670,
                          "start_line": 32,
                          "start_col": 49
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 661,
                        "end": 679,
                        "start_line": 32,
                        "start_col": 49
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
                          "end": 687,
                          "start_line": 32,
                          "start_col": 70
                        }
                      }
                    },
                    "span": {
                      "start": 682,
                      "end": 687,
                      "start_line": 32,
                      "start_col": 70
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
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 702,
                                        "end": 706,
                                        "start_line": 34,
                                        "start_col": 8
                                      }
                                    },
                                    "member": "counter"
                                  }
                                },
                                "span": {
                                  "start": 702,
                                  "end": 716,
                                  "start_line": 34,
                                  "start_col": 8
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 702,
                            "end": 718,
                            "start_line": 34,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 702,
                        "end": 728,
                        "start_line": 34,
                        "start_col": 8
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
                                  "end": 731,
                                  "start_line": 35,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 734,
                                        "end": 738,
                                        "start_line": 35,
                                        "start_col": 14
                                      }
                                    },
                                    "member": "counter"
                                  }
                                },
                                "span": {
                                  "start": 734,
                                  "end": 748,
                                  "start_line": 35,
                                  "start_col": 14
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 728,
                            "end": 748,
                            "start_line": 35,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 728,
                        "end": 758,
                        "start_line": 35,
                        "start_col": 8
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
                                  "end": 768,
                                  "start_line": 36,
                                  "start_col": 8
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
                                        "name": "t",
                                        "type_hint": {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "string"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 781,
                                                "end": 787,
                                                "start_line": 36,
                                                "start_col": 31
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 781,
                                            "end": 787,
                                            "start_line": 36,
                                            "start_col": 31
                                          }
                                        },
                                        "default": null,
                                        "by_ref": false,
                                        "variadic": false,
                                        "is_readonly": false,
                                        "is_final": false,
                                        "visibility": null,
                                        "set_visibility": null,
                                        "attributes": [],
                                        "span": {
                                          "start": 781,
                                          "end": 790,
                                          "start_line": 36,
                                          "start_col": 31
                                        }
                                      },
                                      {
                                        "name": "i",
                                        "type_hint": {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "int"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 792,
                                                "end": 795,
                                                "start_line": 36,
                                                "start_col": 42
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 792,
                                            "end": 795,
                                            "start_line": 36,
                                            "start_col": 42
                                          }
                                        },
                                        "default": null,
                                        "by_ref": false,
                                        "variadic": false,
                                        "is_readonly": false,
                                        "is_final": false,
                                        "visibility": null,
                                        "set_visibility": null,
                                        "attributes": [],
                                        "span": {
                                          "start": 792,
                                          "end": 798,
                                          "start_line": 36,
                                          "start_col": 42
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
                                            "end": 807,
                                            "start_line": 36,
                                            "start_col": 51
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 801,
                                        "end": 807,
                                        "start_line": 36,
                                        "start_col": 51
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
                                                    "end": 813,
                                                    "start_line": 36,
                                                    "start_col": 61
                                                  }
                                                },
                                                "op": "Concat",
                                                "right": {
                                                  "kind": {
                                                    "String": "#"
                                                  },
                                                  "span": {
                                                    "start": 816,
                                                    "end": 819,
                                                    "start_line": 36,
                                                    "start_col": 66
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 811,
                                              "end": 819,
                                              "start_line": 36,
                                              "start_col": 61
                                            }
                                          },
                                          "op": "Concat",
                                          "right": {
                                            "kind": {
                                              "Variable": "i"
                                            },
                                            "span": {
                                              "start": 822,
                                              "end": 824,
                                              "start_line": 36,
                                              "start_col": 72
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 811,
                                        "end": 824,
                                        "start_line": 36,
                                        "start_col": 61
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 771,
                                  "end": 824,
                                  "start_line": 36,
                                  "start_col": 21
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 758,
                            "end": 824,
                            "start_line": 36,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 758,
                        "end": 834,
                        "start_line": 36,
                        "start_col": 8
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
                                  "end": 844,
                                  "start_line": 37,
                                  "start_col": 8
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
                                        "end": 857,
                                        "start_line": 37,
                                        "start_col": 21
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "title"
                                          },
                                          "span": {
                                            "start": 858,
                                            "end": 864,
                                            "start_line": 37,
                                            "start_col": 32
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 858,
                                          "end": 864,
                                          "start_line": 37,
                                          "start_col": 32
                                        }
                                      },
                                      {
                                        "name": null,
                                        "value": {
                                          "kind": {
                                            "Variable": "id"
                                          },
                                          "span": {
                                            "start": 866,
                                            "end": 869,
                                            "start_line": 37,
                                            "start_col": 40
                                          }
                                        },
                                        "unpack": false,
                                        "by_ref": false,
                                        "span": {
                                          "start": 866,
                                          "end": 869,
                                          "start_line": 37,
                                          "start_col": 40
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 847,
                                  "end": 870,
                                  "start_line": 37,
                                  "start_col": 21
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 834,
                            "end": 870,
                            "start_line": 37,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 834,
                        "end": 880,
                        "start_line": 37,
                        "start_col": 8
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
                                    "end": 905,
                                    "start_line": 39,
                                    "start_col": 12
                                  }
                                },
                                "value": {
                                  "kind": {
                                    "Variable": "id"
                                  },
                                  "span": {
                                    "start": 909,
                                    "end": 912,
                                    "start_line": 39,
                                    "start_col": 20
                                  }
                                },
                                "unpack": false,
                                "span": {
                                  "start": 901,
                                  "end": 912,
                                  "start_line": 39,
                                  "start_col": 12
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "title"
                                  },
                                  "span": {
                                    "start": 926,
                                    "end": 933,
                                    "start_line": 40,
                                    "start_col": 12
                                  }
                                },
                                "value": {
                                  "kind": {
                                    "Variable": "formatted"
                                  },
                                  "span": {
                                    "start": 937,
                                    "end": 947,
                                    "start_line": 40,
                                    "start_col": 23
                                  }
                                },
                                "unpack": false,
                                "span": {
                                  "start": 926,
                                  "end": 947,
                                  "start_line": 40,
                                  "start_col": 12
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "priority"
                                  },
                                  "span": {
                                    "start": 961,
                                    "end": 971,
                                    "start_line": 41,
                                    "start_col": 12
                                  }
                                },
                                "value": {
                                  "kind": {
                                    "MethodCall": {
                                      "object": {
                                        "kind": {
                                          "Variable": "priority"
                                        },
                                        "span": {
                                          "start": 975,
                                          "end": 984,
                                          "start_line": 41,
                                          "start_col": 26
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "label"
                                        },
                                        "span": {
                                          "start": 986,
                                          "end": 991,
                                          "start_line": 41,
                                          "start_col": 37
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 975,
                                    "end": 993,
                                    "start_line": 41,
                                    "start_col": 26
                                  }
                                },
                                "unpack": false,
                                "span": {
                                  "start": 961,
                                  "end": 993,
                                  "start_line": 41,
                                  "start_col": 12
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "is_urgent"
                                  },
                                  "span": {
                                    "start": 1007,
                                    "end": 1018,
                                    "start_line": 42,
                                    "start_col": 12
                                  }
                                },
                                "value": {
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
                                                "end": 1031,
                                                "start_line": 42,
                                                "start_col": 27
                                              }
                                            },
                                            "op": "Identical",
                                            "right": {
                                              "kind": {
                                                "ClassConstAccess": {
                                                  "class": {
                                                    "kind": {
                                                      "Identifier": "Priority"
                                                    },
                                                    "span": {
                                                      "start": 1036,
                                                      "end": 1044,
                                                      "start_line": 42,
                                                      "start_col": 41
                                                    }
                                                  },
                                                  "member": "Critical"
                                                }
                                              },
                                              "span": {
                                                "start": 1036,
                                                "end": 1055,
                                                "start_line": 42,
                                                "start_col": 41
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1022,
                                          "end": 1055,
                                          "start_line": 42,
                                          "start_col": 27
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
                                                "end": 1067,
                                                "start_line": 42,
                                                "start_col": 63
                                              }
                                            },
                                            "op": "Identical",
                                            "right": {
                                              "kind": {
                                                "ClassConstAccess": {
                                                  "class": {
                                                    "kind": {
                                                      "Identifier": "Priority"
                                                    },
                                                    "span": {
                                                      "start": 1072,
                                                      "end": 1080,
                                                      "start_line": 42,
                                                      "start_col": 77
                                                    }
                                                  },
                                                  "member": "High"
                                                }
                                              },
                                              "span": {
                                                "start": 1072,
                                                "end": 1086,
                                                "start_line": 42,
                                                "start_col": 77
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1058,
                                          "end": 1086,
                                          "start_line": 42,
                                          "start_col": 63
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1022,
                                    "end": 1086,
                                    "start_line": 42,
                                    "start_col": 27
                                  }
                                },
                                "unpack": false,
                                "span": {
                                  "start": 1007,
                                  "end": 1086,
                                  "start_line": 42,
                                  "start_col": 12
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 887,
                            "end": 1097,
                            "start_line": 38,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 880,
                        "end": 1103,
                        "start_line": 38,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 616,
                "end": 1105,
                "start_line": 32,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 554,
        "end": 1106,
        "start_line": 28,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1106,
    "start_line": 1,
    "start_col": 0
  }
}

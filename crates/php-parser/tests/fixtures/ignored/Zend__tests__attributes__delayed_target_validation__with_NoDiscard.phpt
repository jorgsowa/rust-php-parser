===source===
<?php

#[DelayedTargetValidation]
#[NoDiscard] // Does nothing here
class DemoClass {
	#[DelayedTargetValidation]
	#[NoDiscard] // Does nothing here
	public $val;

	public string $hooked {
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		set => $value;
	}

	#[DelayedTargetValidation]
	#[NoDiscard] // Does nothing here
	public const CLASS_CONST = 'FOO';

	public function __construct(
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		$str
	) {
		echo "Got: $str\n";
		$this->val = $str;
	}

	#[DelayedTargetValidation]
	#[NoDiscard] // Does something here
	public function printVal() {
		echo 'Value is: ' . $this->val . "\n";
		return 123;
	}
}

#[DelayedTargetValidation]
#[NoDiscard] // Does something here
function demoFn() {
	echo __FUNCTION__ . "\n";
	return 456;
}

#[DelayedTargetValidation]
#[NoDiscard] // Does nothing here
const GLOBAL_CONST = 'BAR';

$d = new DemoClass('example');
$d->printVal();
$v = $d->printVal();
var_dump($d->val);
$d->hooked = "foo";
var_dump($d->hooked);
// NoDiscard does not support property hooks, this should not complain
$d->hooked;
var_dump(DemoClass::CLASS_CONST);
demoFn();
$v = demoFn();
var_dump(GLOBAL_CONST);
?>
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 10
===php_error 8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 49
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 74,
              "end": 83
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
                    "name": "val",
                    "span": {
                      "start": 157,
                      "end": 161
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 89,
                          "end": 112
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 89,
                        "end": 112
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 117,
                          "end": 126
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 117,
                        "end": 126
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 87,
                "end": 161
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "hooked",
                    "span": {
                      "start": 179,
                      "end": 186
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 172,
                          "end": 178
                        }
                      }
                    },
                    "span": {
                      "start": 172,
                      "end": 178
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 263,
                                  "end": 268
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "hooked"
                                },
                                "span": {
                                  "start": 270,
                                  "end": 276
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 263,
                            "end": 276
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 193,
                              "end": 216
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 193,
                            "end": 216
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 222,
                              "end": 231
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 222,
                            "end": 231
                          }
                        }
                      ],
                      "span": {
                        "start": 191,
                        "end": 277
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 352,
                            "end": 358
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 282,
                              "end": 305
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 282,
                            "end": 305
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 311,
                              "end": 320
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 311,
                            "end": 320
                          }
                        }
                      ],
                      "span": {
                        "start": 280,
                        "end": 359
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 165,
                "end": 362
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "CLASS_CONST",
                    "span": {
                      "start": 441,
                      "end": 452
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "value": {
                    "kind": {
                      "String": "FOO"
                    },
                    "span": {
                      "start": 455,
                      "end": 460
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 367,
                          "end": 390
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 367,
                        "end": 390
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 395,
                          "end": 404
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 395,
                        "end": 404
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 365,
                "end": 461
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 480,
                      "end": 491
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "str",
                        "span": {
                          "start": 560,
                          "end": 564
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 497,
                              "end": 520
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 497,
                            "end": 520
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 526,
                              "end": 535
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 526,
                            "end": 535
                          }
                        }
                      ],
                      "span": {
                        "start": 495,
                        "end": 564
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "InterpolatedString": [
                                {
                                  "Literal": "Got: "
                                },
                                {
                                  "Expr": {
                                    "kind": {
                                      "Variable": "str"
                                    },
                                    "span": {
                                      "start": 583,
                                      "end": 587
                                    }
                                  }
                                },
                                {
                                  "Literal": "\n"
                                }
                              ]
                            },
                            "span": {
                              "start": 577,
                              "end": 590
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 572,
                        "end": 591
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
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 594,
                                        "end": 599
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "val"
                                      },
                                      "span": {
                                        "start": 601,
                                        "end": 604
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 594,
                                  "end": 604
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "str"
                                },
                                "span": {
                                  "start": 607,
                                  "end": 611
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 594,
                            "end": 611
                          }
                        }
                      },
                      "span": {
                        "start": 594,
                        "end": 612
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 464,
                "end": 615
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "printVal",
                    "span": {
                      "start": 699,
                      "end": 707
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
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "String": "Value is: "
                                        },
                                        "span": {
                                          "start": 719,
                                          "end": 731
                                        }
                                      },
                                      "op": "Concat",
                                      "right": {
                                        "kind": {
                                          "PropertyAccess": {
                                            "object": {
                                              "kind": {
                                                "Variable": "this"
                                              },
                                              "span": {
                                                "start": 734,
                                                "end": 739
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "val"
                                              },
                                              "span": {
                                                "start": 741,
                                                "end": 744
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 734,
                                          "end": 744
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 719,
                                    "end": 744
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "String": "\n"
                                  },
                                  "span": {
                                    "start": 747,
                                    "end": 751
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 719,
                              "end": 751
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 714,
                        "end": 752
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 123
                          },
                          "span": {
                            "start": 762,
                            "end": 765
                          }
                        }
                      },
                      "span": {
                        "start": 755,
                        "end": 766
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 620,
                          "end": 643
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 620,
                        "end": 643
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 648,
                          "end": 657
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 648,
                        "end": 657
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 618,
                "end": 769
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 9,
                  "end": 32
                }
              },
              "args": [],
              "span": {
                "start": 9,
                "end": 32
              }
            },
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 68,
        "end": 771
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "demoFn",
            "span": {
              "start": 845,
              "end": 851
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "MagicConst": "Function"
                          },
                          "span": {
                            "start": 862,
                            "end": 874
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": "\n"
                          },
                          "span": {
                            "start": 877,
                            "end": 881
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 862,
                      "end": 881
                    }
                  }
                ]
              },
              "span": {
                "start": 857,
                "end": 882
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 456
                  },
                  "span": {
                    "start": 891,
                    "end": 894
                  }
                }
              },
              "span": {
                "start": 884,
                "end": 895
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 775,
                  "end": 798
                }
              },
              "args": [],
              "span": {
                "start": 775,
                "end": 798
              }
            },
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 802,
                  "end": 811
                }
              },
              "args": [],
              "span": {
                "start": 802,
                "end": 811
              }
            }
          ]
        }
      },
      "span": {
        "start": 836,
        "end": 897
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "GLOBAL_CONST",
              "span": {
                "start": 966,
                "end": 978
              }
            },
            "value": {
              "kind": {
                "String": "BAR"
              },
              "span": {
                "start": 981,
                "end": 986
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "DelayedTargetValidation"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 901,
                    "end": 924
                  }
                },
                "args": [],
                "span": {
                  "start": 901,
                  "end": 924
                }
              },
              {
                "name": {
                  "parts": [
                    "NoDiscard"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 928,
                    "end": 937
                  }
                },
                "args": [],
                "span": {
                  "start": 928,
                  "end": 937
                }
              }
            ],
            "span": {
              "start": 966,
              "end": 986
            }
          }
        ]
      },
      "span": {
        "start": 960,
        "end": 987
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 989,
                  "end": 991
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
                            "DemoClass"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 998,
                            "end": 1007
                          }
                        }
                      },
                      "span": {
                        "start": 998,
                        "end": 1007
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "example"
                            },
                            "span": {
                              "start": 1008,
                              "end": 1017
                            }
                          }
                        },
                        "span": {
                          "start": 1008,
                          "end": 1017
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 994,
                  "end": 1018
                }
              }
            }
          },
          "span": {
            "start": 989,
            "end": 1018
          }
        }
      },
      "span": {
        "start": 989,
        "end": 1019
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 1020,
                  "end": 1022
                }
              },
              "method": {
                "kind": {
                  "Identifier": "printVal"
                },
                "span": {
                  "start": 1024,
                  "end": 1032
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 1020,
            "end": 1034
          }
        }
      },
      "span": {
        "start": 1020,
        "end": 1035
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "v"
                },
                "span": {
                  "start": 1036,
                  "end": 1038
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 1041,
                        "end": 1043
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "printVal"
                      },
                      "span": {
                        "start": 1045,
                        "end": 1053
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 1041,
                  "end": 1055
                }
              }
            }
          },
          "span": {
            "start": 1036,
            "end": 1055
          }
        }
      },
      "span": {
        "start": 1036,
        "end": 1056
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1057,
                      "end": 1065
                    }
                  }
                },
                "span": {
                  "start": 1057,
                  "end": 1065
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "d"
                            },
                            "span": {
                              "start": 1066,
                              "end": 1068
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "val"
                            },
                            "span": {
                              "start": 1070,
                              "end": 1073
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1066,
                        "end": 1073
                      }
                    }
                  },
                  "span": {
                    "start": 1066,
                    "end": 1073
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1057,
            "end": 1074
          }
        }
      },
      "span": {
        "start": 1057,
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 1076,
                        "end": 1078
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "hooked"
                      },
                      "span": {
                        "start": 1080,
                        "end": 1086
                      }
                    }
                  }
                },
                "span": {
                  "start": 1076,
                  "end": 1086
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "foo"
                },
                "span": {
                  "start": 1089,
                  "end": 1094
                }
              }
            }
          },
          "span": {
            "start": 1076,
            "end": 1094
          }
        }
      },
      "span": {
        "start": 1076,
        "end": 1095
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1096,
                      "end": 1104
                    }
                  }
                },
                "span": {
                  "start": 1096,
                  "end": 1104
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "d"
                            },
                            "span": {
                              "start": 1105,
                              "end": 1107
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "hooked"
                            },
                            "span": {
                              "start": 1109,
                              "end": 1115
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1105,
                        "end": 1115
                      }
                    }
                  },
                  "span": {
                    "start": 1105,
                    "end": 1115
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1096,
            "end": 1116
          }
        }
      },
      "span": {
        "start": 1096,
        "end": 1117
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 1189,
                  "end": 1191
                }
              },
              "property": {
                "kind": {
                  "Identifier": "hooked"
                },
                "span": {
                  "start": 1193,
                  "end": 1199
                }
              }
            }
          },
          "span": {
            "start": 1189,
            "end": 1199
          }
        }
      },
      "span": {
        "start": 1189,
        "end": 1200
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1201,
                      "end": 1209
                    }
                  }
                },
                "span": {
                  "start": 1201,
                  "end": 1209
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "DemoClass"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1210,
                                  "end": 1219
                                }
                              }
                            },
                            "span": {
                              "start": 1210,
                              "end": 1219
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "CLASS_CONST"
                            },
                            "span": {
                              "start": 1221,
                              "end": 1232
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1210,
                        "end": 1232
                      }
                    }
                  },
                  "span": {
                    "start": 1210,
                    "end": 1232
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1201,
            "end": 1233
          }
        }
      },
      "span": {
        "start": 1201,
        "end": 1234
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
                      "demoFn"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1235,
                      "end": 1241
                    }
                  }
                },
                "span": {
                  "start": 1235,
                  "end": 1241
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 1235,
            "end": 1243
          }
        }
      },
      "span": {
        "start": 1235,
        "end": 1244
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "v"
                },
                "span": {
                  "start": 1245,
                  "end": 1247
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
                            "demoFn"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1250,
                            "end": 1256
                          }
                        }
                      },
                      "span": {
                        "start": 1250,
                        "end": 1256
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 1250,
                  "end": 1258
                }
              }
            }
          },
          "span": {
            "start": 1245,
            "end": 1258
          }
        }
      },
      "span": {
        "start": 1245,
        "end": 1259
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1260,
                      "end": 1268
                    }
                  }
                },
                "span": {
                  "start": 1260,
                  "end": 1268
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
                            "GLOBAL_CONST"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1269,
                            "end": 1281
                          }
                        }
                      },
                      "span": {
                        "start": 1269,
                        "end": 1281
                      }
                    }
                  },
                  "span": {
                    "start": 1269,
                    "end": 1281
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1260,
            "end": 1282
          }
        }
      },
      "span": {
        "start": 1260,
        "end": 1283
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1283
  }
}

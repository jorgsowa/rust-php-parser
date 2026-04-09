===source===
<?php

break;
break 2;

continue;
continue 2;

return;
return $a;

throw $e;

label:
goto label;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Break": null
      },
      "span": {
        "start": 7,
        "end": 14,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Break": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 20,
            "end": 21,
            "start_line": 4,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 14,
        "end": 24,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Continue": null
      },
      "span": {
        "start": 24,
        "end": 34,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Continue": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 43,
            "end": 44,
            "start_line": 7,
            "start_col": 9
          }
        }
      },
      "span": {
        "start": 34,
        "end": 47,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Return": null
      },
      "span": {
        "start": 47,
        "end": 55,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Return": {
          "kind": {
            "Variable": "a"
          },
          "span": {
            "start": 62,
            "end": 64,
            "start_line": 10,
            "start_col": 7
          }
        }
      },
      "span": {
        "start": 55,
        "end": 67,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Throw": {
          "kind": {
            "Variable": "e"
          },
          "span": {
            "start": 73,
            "end": 75,
            "start_line": 12,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 67,
        "end": 78,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Label": "label"
      },
      "span": {
        "start": 78,
        "end": 85,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Goto": "label"
      },
      "span": {
        "start": 85,
        "end": 96,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96,
    "start_line": 1,
    "start_col": 0
  }
}

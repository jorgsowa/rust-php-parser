===source===
<?php
goto end;
echo 'this is skipped';
end:
echo 'done';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Goto": "end"
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
              "String": "this is skipped"
            },
            "span": {
              "start": 21,
              "end": 38
            }
          }
        ]
      },
      "span": {
        "start": 16,
        "end": 40
      }
    },
    {
      "kind": {
        "Label": "end"
      },
      "span": {
        "start": 40,
        "end": 45
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "done"
            },
            "span": {
              "start": 50,
              "end": 56
            }
          }
        ]
      },
      "span": {
        "start": 45,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}

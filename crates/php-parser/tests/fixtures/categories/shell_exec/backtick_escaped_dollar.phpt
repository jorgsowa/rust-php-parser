===source===
<?php
`echo \$var`;
`\$test`;
`prefix\$suffix`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "echo $var"
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "$test"
              }
            ]
          },
          "span": {
            "start": 20,
            "end": 28
          }
        }
      },
      "span": {
        "start": 20,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "prefix$suffix"
              }
            ]
          },
          "span": {
            "start": 30,
            "end": 46
          }
        }
      },
      "span": {
        "start": 30,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}

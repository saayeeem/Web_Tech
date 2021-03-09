graph = {
    "S": {"G": 9, "A": 2,"B": 1},
    "G": {"S": 9, "C": 4,"D": 4},
    "A": {"C": 2, "D": 3},
    "B": {"D": 2, "E": 4},
    "C": {"A": 2, "G":4},
    "D": {"B": 2, "E": 4},
    "E": {"B":4}
}
heuriticSLD = {
    "S": 6,
    "A": 0,
    "B": 6,
    "C": 4,
    "D": 1,
    "E": 10,
    "G": 0
}
class graphProblem:

    def __init__(self,initial,goal,graph):
        self.initial=initial
        self.goal=goal
        self.graph=graph
    def actions(self,state):
        return list(self.graph[state].keys())

    def result(self,state,action):
        return action

    def goal_test(self,state):
        return state == self.goal

    def path_cost(self,cost_so_far,state1,action,state2):
        return cost_so_far + self.graph[state1][state2]



class Node:
    def __init__(self,state,parent=None,action=None,path_cost=0):
        self.state=state
        self.parent=parent
        self.action=action
        self.path_cost=path_cost

    def expand(self,graphProblem):
        return [self.child_node(graphProblem,action)
                for action in graphProblem.actions(self.state)]

    def child_node(self,graphProblem,action):
        next_state=graphProblem.result(self.state,action)
        return Node(next_state,self,action,
                    graphProblem.path_cost(self.path_cost,self.state,action,next_state))
    def path(self):
        node, path_back = self, []

        while node:
            path_back.append(node)
            node = node.parent


        return list(reversed(path_back))

    def solution(self):
        return [node.action for node in self.path()[1:]]
    def __repr__(self):
        return f'{self.state}' 


gp=graphProblem("S","G",graph)
node = Node(gp.initial)
def UniformCostSearch(gp,popIndex,f):
    frontier = []
    frontier.append(node)
    explored = set()

    while frontier:
        if len(frontier) == 0: return "Failed"

        child = frontier.pop(popIndex)

        if(gp.goal_test(child.state) == True):
            #print("We reach our goal")
            #print("Frontier: ",frontier)
            #print("Explored: ",explored)
            return child
            break

        else:
            explored.add(child.state)
            action = child.expand(gp)
            for a in action:
                if a.state not in explored and a not in frontier:
                    frontier.append(a)
                    frontier.sort(key = f)


def heuriticSLDSearch(gp,f):
    frontier = []
    frontier.append(node)
    explored = set()
    child = []
    while frontier:
        if len(frontier) == 0: return "Failed"

        child = frontier.pop(0)

        if(gp.goal_test(child.state) == True):
            #print("We reach our goal")
            #print("Frontier: ",frontier)
            #print("Explored: ",explored)
            return child
            break

        else:
            explored.add(child.state)
            action = child.expand(gp)
            for a in action:
                if a.state not in explored and a not in frontier:
                    frontier.append(a)
                    frontier.sort(key = f)


def ucs(gp):
    print("======UCS==============")
    return UniformCostSearch(gp,popIndex=0,f= lambda child:child.path_cost)
def gbps(gp):
    print("======GBFS==============")
    return heuriticSLDSearch(gp,f = lambda child: heuriticSLD[child.state])
def allStar(gp):
    print("======ALL Star==============")
    return heuriticSLDSearch(gp,f= lambda child:child.path_cost + heuriticSLD[child.state])
ucsresult = ucs(gp)
print(ucsresult.solution(),ucsresult.path_cost,ucsresult.expand(gp))
gbpsresult = gbps(gp)
print(gbpsresult.solution(),gbpsresult.path_cost)
allStarresult = allStar(gp)
print(allStarresult.solution(),allStarresult.path_cost)
